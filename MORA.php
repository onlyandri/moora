<?php
error_reporting(E_ALL | E_STRICT);

echo "Using training data to generate Decision tree...\n";
$dec_tree = new DecisionTree('historical_data.csv', 0);
echo "Decision tree using ID3:\n";
$dec_tree->display();
echo "Prediction on new data set\n";
$dec_tree->predict_outcome('input_data.csv');
exit();

class Tree {
	protected	$root;
	private		$currentNode;
	
	public function __construct($root) {
		$this->root = $root;
	}
	
	public function display() {
		$this->root->display(0);
	}
}

class Node {
	public 	$value;
	public	$namedBranches;
	public function __construct($new_item) {
		$this->value = $new_item;
		$this->namedBranches=array();
	}
	
	public function display($level) {
		echo $this->value . "\n";
		foreach($this->namedBranches as $b => $child_node) {
			echo str_repeat(" ", ($level+1)*4) . str_repeat("-", 14/2 - strlen($b)/2) . $b . str_repeat("-", 14/2 - strlen($b)/2) . ">";
			$child_node->display($level + 1);
		}
	}	
	public function get_parent() {
		return ($this->tree);
	}
}

class DecisionTree extends Tree {
	private $training_data;
	private $display_debug;

	public function __construct($csv_with_header, $display_debug=0) {	
		$this->display_debug = $display_debug;
		$this->training_data = $this->csv_to_array($csv_with_header);
		array_pop($this->training_data['header']);		
		parent::__construct(new Node('Root'));
		$this->find_root($this->root, 'Any', $this->training_data);
	}
	
	public function predict_outcome($data_file) {
		$this->input_data = $this->csv_to_array($data_file);
		$data 	= $this->input_data['samples'];
		$header = $this->input_data['header'];
		//$row = $data[0];
		//print_r($row);
		foreach($data as $k => $row) {
			$row['result'] = $this->predict($this->root, $row);	
			$data[$k] = $row;
		}
		echo "\n";
		print_r($data);
	}
	
	private function predict($node, $data_row) {
		//we have reached a leaf node
		if ( !count($node->namedBranches) ) {
			print_r("\nReturning " . $node->value);	
			return $node->value;
		}
		if ( array_key_exists($node->value, $data_row) ) {
			print_r("\nValue of " . $node->value . " is " . $data_row[$node->value]);
			if ( array_key_exists($data_row[$node->value], $node->namedBranches) ) {
				print_r("\nBranch " . $data_row[$node->value] . " exists and leads to node " . $node->namedBranches[$data_row[$node->value]]->value);
				$next_node = $node->namedBranches[$data_row[$node->value]];
				return($this->predict($next_node, $data_row));
			}
				/*if ( $value != null ) {			
					return $value;
				}
			}
			else {
				print_r ("\nReturning " . $node->value);
				return $node->value;
			}*/
		}
		print_r("\nInvalid path");
		return null;
	}
	
	private function csv_to_array($filename='', $delimiter=',')
	{
		$training_data = array();
		if(!file_exists($filename) || !is_readable($filename))
			return false;

		$header 	= array();
		$samples 	= array();
		
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			{
				if(!$header) {
					$header = $row;
				}
				else {
					$samples[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}
		foreach ($header as $value) {
			$new_header[$value] = 1;
		}	
		$training_data['header'] 	= $new_header;
		$training_data['samples'] 	= $samples;
		return $training_data;
	}

	private function find_root($parent_node, $branch_name, $training_data) {
		if ( $parent_node->value == 'Root' ){
			if ($this->display_debug){print_r("Node:Root  Branch:Any\n");}
		} else {
			if ($this->display_debug){print_r("Node:" . $parent_node->value . " Branch:" . $branch_name . "\n");}
		}
		if ($this->display_debug){print_r("\nThis is the data we are working on:\n");}
		if ($this->display_debug){print_r($training_data);}
		
		$S 		= $training_data['samples'];
		$header = $training_data['header'];

		$p = $this->possible_values($S, 'value');
		if ( count($p) == 1 )
		{
			reset($p);
			if ($this->display_debug){print_r("End of this branch with value:" . strtoupper(key($p)) . "!!\n\n");}
			$parent_node->namedBranches[$branch_name] = new Node(strtoupper(key($p)));
			return;
		}
		$winning_attribute = 'none';	
		foreach (array_keys($header) as $h) {
			$g = $this->gain($S, $h);
			if ( empty($max_gain) || ($g > $max_gain) ) {
				$max_gain = $g; 
				$winning_attribute = $h;
			}
		}
		if ( $parent_node->value != 'Root' ) {
			$parent_node->namedBranches[$branch_name] = new Node($winning_attribute);
			$parent_node = $parent_node->namedBranches[$branch_name];
		} else {
			$parent_node->value = $winning_attribute;
		}
		
		if ($this->display_debug){print_r("New Root attribute:" . $winning_attribute . "\n");}
		$p = $this->possible_values($S, $winning_attribute);
		foreach ($p as $value => $count) {
			$subset = $this->create_subset($training_data, $winning_attribute, $value);
			if ($this->display_debug){print_r($winning_attribute . "->" . $value . "\n");}
			$this->find_root($parent_node, $value, $subset);
		}	
		return;
	}

	private function gain($s, $attr) {
		if ($this->display_debug){print_r("Finding Gain for " . $attr . "...\n");}
		$gain_reduction = 0.0;
		$total_count = count($s);
		
		$possible_values_count = $this->possible_values($s, $attr);
		if ($this->display_debug){print_r($possible_values_count);}
		if ($this->display_debug){print_r("Sigma terms:");}
		foreach ($possible_values_count as $k => $v) {
			$e = $this->entropy($s, $attr, $k);
			$gain_reduction += $v * $e  / $total_count;
			if ($this->display_debug){print_r("\n|Sn|:" . $v . " |S|:" . $total_count . " Entropy(Sn):" . $e);}
		}
		$e = $this->entropy($s);	
		$ret = $e - $gain_reduction;
		if ($this->display_debug){print_r("\nGain for " . $attr . ": " . $ret . "\n\n");}
		return $ret;
	}

	private function entropy($s, $attr=null, $value=null) {
		if ( $attr != null ) {
			$p = $this->calculate_p($s, $attr, $value);
			if ($this->display_debug){print_r("\nEntropy of attribute " . $attr . "/" . $value. ": " );}
		}
		else {
			$p = $this->calculate_p($s, null, null);
			if ($this->display_debug){print_r("\nEntropy of the system: " );}		
		}
		$ret = ($p['yes'] ? - $p['yes'] * log($p['yes'], 2): 0) - ($p['no'] ? $p['no'] * log($p['no'], 2) : 0);
		if ($this->display_debug){print_r($ret);}
		return $ret;
	}

	private function calculate_p($s, $attr, $attr_value) {
		if ($attr != null) {
			if ($this->display_debug){print_r("\nCalculating p's for " . $attr . " with a value of " . $attr_value . ":");}
		}
		else {
			if ($this->display_debug){print_r("\nCalculating p's for the entire system:");}
		}	
		$p = array('no'=> 0, 'yes' => 0);	
		try {
			foreach($s as $si) {
				if ( $attr == null ) {
					$p[$si['value']]++;
				}
				else if ( $si[$attr] ==  $attr_value ) {
					$p[$si['value']]++;
				}
			}
			/*print_r("\t\t" . __FUNCTION__ . "::value of p:");
			print_r($p);
			print_r("\t\t\n}" );	*/
			
			$total = $p['yes'] + $p['no'];
			
			if ($this->display_debug){print_r("\nYES:". $p['yes'] . "  NO:" . $p['no'] . "  TOTAL:" . $total);}	
			if ($total != 0) {
				$p['yes'] 	/= $total;
				$p['no'] 	/= $total;
			}
			else {
				die("You are dividing by ZERO, idiot!");
			}
		}
		catch (Exception $e) {
			die("\n" . $e->getMessage());
		}
		return ($p);
	}

	private function possible_values($s, $attr) {	
		$possible_values_count = array();
		foreach ($s as $si) {
			$possible_values_count[$si[$attr]] = array_key_exists($si[$attr], $possible_values_count) ? $possible_values_count[$si[$attr]] + 1 : 1;
		}
		return $possible_values_count;
	}

	private function create_subset($data, $target_attribute, $value) {
		$header 	= $data['header'];
		$samples 	= $data['samples'];
		
		unset($header[$target_attribute]);
		foreach ($samples as $si) {
			if ( $si[$target_attribute] == $value ) {
				unset($si[$target_attribute]);
				$new_samples[] = $si;
			}
		}
		$new_data['header'] = $header;
		$new_data['samples'] = $new_samples;
		return($new_data);
	}
}








<?php namespace Jincongho\DecisionTree;

class DecisionTree {
	protected $tree;

	protected $attrnum;

	protected $training_set = array();

	protected $outputs = array();

	protected $gain = array();

	public function setAttrNum($num) {
		$this->attrnum = $num;
		return $this;
	}

	public function getAttrNum($num) {
		return $this->attrnum;
	}

	public function getTree() {
		return $this->tree;
	}

	public function getGain() {
		return $this->gain;
	}

	public function addTrainingSet($training_array = array()) {
		foreach ($training_array as $instance) {
			$this->training_set[] = $instance;
		}

		$this->outputs = $this->getOutputs($this->training_set);

		return $this;
	}

	public function getTrainingSet() {
		return $this->training_set;
	}

	public function startTraining() {

		$this->gain = $this->getGains($this->training_set, $this->attrnum);
		$gain = array_keys($this->gain);
		$this->tree = $this->buildTree(
			$this->training_set,
			array_pop($gain),
			$gain
		);

		return $this->tree;

	}

	public function classify($instance = array()) {
		if ((count($instance) < $this->attrnum)) {
			throw new \BadFunctionCallException('Attribute\'s number in instance passed for labelling is unmatched.');
		}

		if (!isset($this->gain)) {
			throw new \BadFunctionCallException('Must run training before labelling.');
		}

		$route = array();
		foreach($this->gain as $key=>$gain){
			$route[] = $instance[$key];
		}

		return $this->transverseTree($this->tree, $route);
	}

	protected function buildTree($training_set, $target_attr, $attr = array()) {
		$column  = $target_attr;
		$outputs = $this->getOutputs($training_set);
		if (count($outputs) === 1) {
			return new TreeLabel($outputs[0]);
		} elseif (count($attr) === 0) {
			$values = $this->getValues($training_set, $column);
			$prob   = $this->countProb($training_set, $column);
			$node   = array();
			foreach ($values as $value) {
				end($prob[$value]);
				$label        = key($prob[$value]);
				$node[$value] = new TreeLabel($label);
			}

			return new TreeNode($node);
		} else {
			$values = $this->getValues($training_set, $column);
			$node   = array();
			foreach ($values as $value) {
				$node[$value] = $this->buildTree(
					$this->getSetsOf($training_set, $column, $value),
					array_pop($attr),
					$attr
				);
			}
			return new TreeNode($node);
		}
	}

	protected function transverseTree($tree, $values) {
		/*if (is_a($tree, 'Jincongho\DecisionTree\TreeLabel')) {
			return $tree;
		} else {
			try{
				
			}catch(\Exception $e){
				//@TODO
			}
			$tree = $tree->{array_pop($values)};
			return $this->transverseTree($tree, $values);
		}*/
		while($values){
			if(is_a($tree, 'Jincongho\DecisionTree\TreeLabel')){
				break;
			}else{
				try{
					$tree = $tree->{array_pop($values)};
				}catch(\Exception $e){

				}
			}
		}
		return $tree;
	}

	protected function getOutputs($training_set) {
		$outputs = array();
		foreach ($training_set as $set) 
			if (!in_array($set[1], $outputs)) 
				$outputs[] = $set[1];

		return $outputs;
	}

	protected function getValues($training_set, $column) {
		$values = array();
		foreach ($training_set as $set) 
			if (!in_array($set[0][$column], $values)) 
				$values[] = $set[0][$column];

		return $values;
	}

	protected function getGains($training_set, $attrnum) {
		$gain = array();
		for ($i = 0; $i < $attrnum; $i++) {
			$gain[$i] = $this->countGain($training_set, $i);
		}
		asort($gain);

		return $gain;
	}

	protected function getSetsOf($training_set, $column, $value, $output = null) {
		return array_filter($training_set, function ($input) use ($column, $value, $output) {
			if ($output == null) {
				return ($input[0][$column] == $value);
			} else {
				return (($input[0][$column] == $value) and ($input[1] == $output));
			}
		});
	}

	protected function countEntropy($data) {
		$count = array();
		foreach ($data as $set) {
			if (!isset($count[$set[1]])) 
				$count[$set[1]] = 1;
			else
				$count[$set[1]]++;
		}

		$entropy = 0;
		$total   = array_sum($count);
		foreach ($count as $value) 
			$entropy += -($value / $total) * log($value / $total, 2);

		return $entropy;
	}

	protected function countGain($data, $column) {
		$entropy = $this->countEntropy($data);

		$count = array();
		foreach ($data as $set) {
			if (!isset($count[$set[0][$column]])) 
				$count[$set[0][$column]] = array();

			if (!isset($count[$set[0][$column]][$set[1]])) 
				$count[$set[0][$column]][$set[1]] = 0;

			$count[$set[0][$column]][$set[1]]++;
		}

		$gain  = 0;
		$total = count($data);
		foreach ($count as $key => $values) {
			$gain -= (array_sum($values) / $total) * $this->countEntropy(array_filter($data, function ($set) use ($column, $key) {
					return ($set[0][$column] == $key);
				}
			));
		}

		return $entropy + $gain;
	}

	public function countProb($data, $column) {
		$values  = $this->getValues($data, $column);
		$outputs = $this->getOutputs($data);
		$prob    = array();
		foreach ($values as $value) {
			$prob[$value] = array();
			foreach ($this->getSetsOf($data, $column, $value) as $set) {
				if(!isset($prob[$value][$set[1]]))
					$prob[$value][$set[1]] = 1;
				else
					$prob[$value][$set[1]]++;
			}
			foreach ($outputs as $out) {
				$total = count($this->getSetsOf($data, $column, $value, $out));
				$prob[$value][$out] = 0;
				if ($total != 0)  
					$prob[$value][$out] = $prob[$value][$out] / $total;
			}
			asort($prob[$value]);
		}

		return $prob;

	}
}