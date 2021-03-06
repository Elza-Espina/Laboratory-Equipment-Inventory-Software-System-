<?php

class EquipmentModel extends CI_Model {

	public $eqpName;
	public $eqpSerialNum;
	public $price;
    public $compName;
    public $compSerialNum;
    public $compPrice;

	function __construct(){
        parent::__construct();
    }

    public function getAllEquipments(){
        $this->db->select('count(*) as "quantity", eqpName');
        $this->db->from('equipment');
        $this->db->group_by('eqpName'); 

        return $this->db->get()->result_array();
    }

    public function addEquipment(){
        $data = array(
            'eqpName' => $_POST['eqpName'],
            'eqpSerialNum' => $_POST['eqpSerialNum'],
            'labID' => $_POST['labID'],  
            'price' => $_POST['eqpPrice']
        );

    	return $this->db->insert('equipment',$data);
    }

    public function addEquipmentComp(){
        $data = array(
            'compName' => $_POST['compName'],
            'compSerialNum' => $_POST['compSerialNum'],
            'labID' => $_POST['labID'],                        
            'price' => $_POST['compPrice']
        );

        return $this->db->insert('component',$data);
    }

    public function getEquipmentList($labID){
<<<<<<< HEAD

        // $labID=$_POST['labID'];

=======
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
        $result = array();

        $this->db->select('*');
        $this->db->from('laboratory');
        $this->db->where('labID', $labID);
        $result[] = $this->db->get()->result_array();

        $this->db->select('eqp.*');
        $this->db->from('laboratory lab');
        $this->db->join('equipment eqp', 'eqp.labID = lab.labID', 'left');
        $this->db->where('eqp.labID', $labID);
        $result[] = $this->db->get()->result_array();

        $this->db->select('comp.*');
        $this->db->from('laboratory labb');
        $this->db->join('component comp', 'comp.labID = labb.labID', 'left');
        $this->db->where('comp.labID', $labID);
        $result[] = $this->db->get()->result_array();

        return $result;
    }

<<<<<<< HEAD

=======
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
    public function getLabEquipmentList(){

        $labID = $_POST['labID'];

        $this->db->select('*');
        $this->db->from('equipment');
        $this->db->where('labID', $labID);
        
        $result = $this->db->get()->result_array();

        return $result;
    }

    public function getEquipments(){
        $filter = $_POST['search'];

        $this->db->select('eqpSerialNum, eqpName');
        $this->db->from('equipment');

<<<<<<< HEAD
        if($_POST['labID']){
            $this->db->where('labID',$_POST['labID']);
        }

        if($_POST['labID'] && $filter == 'available'){
            $this->db->where('labID='.$_POST['labID'].' and eqpSerialNum NOT IN (SELECT eqpSerialNum FROM borrowed_list) and eqpSerialNum NOT IN (SELECT eqpSerialNum FROM damaged_list)');
=======
        if($filter == 'undamagedEquipments' || $filter == 'unborrowedEquipments'){
            $this->db->where('eqpSerialNum NOT IN (SELECT eqpSerialNum FROM borrowed_list) and eqpSerialNum NOT IN (SELECT eqpSerialNum FROM damaged_list)', NULL, FALSE);
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
        }

    	$list = $this->db->get()->result_array();
    	$equipmentList = array();
    	foreach ($list as $key) {
    		$equipmentList[] = $key['eqpSerialNum']." - ".$key['eqpName'];
    	}
    	return $equipmentList;
    }

    public function searchEquipment(){
    	$this->db->select('*');
    	$this->db->from('equipment');
     	$searchThis = array('eqpSerialNum' => $_POST['equipmentSerialNum'], 'eqpName' => $_POST['equipmentName']);
     	$this->db->where($searchThis);
    	$result = $this->db->get()->result_array();

		return $result;
    }

<<<<<<< HEAD

    public function getAvailableEquipments(){
        $labID = $_POST['labID'];
        $where= "labID =".$labID." AND eqpSerialNum NOT IN (SELECT eqpSerialNum FROM damaged_list) AND eqpSerialNum NOT IN (SELECT eqpSerialNum FROM borrowed_list)";
        $this->db->select('*');
        $this->db->from('equipment');
        $this->db->where($where);
=======
    public function getDamageEquipments(){
        $this->db->select('*');
        $this->db->from('equipment');
        $this->db->where('eqpSerialNum NOT IN (SELECT eqpSerialNum FROM damaged_list) AND eqpSerialNum NOT IN (SELECT eqpSerialNum FROM borrowed_list)', NULL, FALSE);
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
        
        $result = $this->db->get()->result_array();

        return $result;
    }

    public function getEquipmentDetails(){
        $equipment = $_POST['equipmentSerialNum'];

        $this->db->select('eqpSerialNum as "serialNum", eqpName as "name", price as "price"');
        $this->db->from('equipment');
        $this->db->where('eqpSerialNum', $equipment);
        $result = $this->db->get()->result_array();
        if($result){

        }else{
            $this->db->select('compSerialNum as "serialNum", compName as "name", price as "price"');
            $this->db->from('component');
            $this->db->where('compSerialNum', $equipment);
            $result = $this->db->get()->result_array();
        }

        return $result;
    }

    public function updateEquipment(){
        $this->db->where('eqpSerialNum', $_POST['eqpSerialNum']);
        $query = $this->db->get('equipment');
        if ($query->num_rows() > 0){
            $data = array(
                'eqpName' => $_POST['eqpName'],
                'eqpSerialNum' => $_POST['eqpSerialNum'], 
                'price' => $_POST['eqpPrice']
            );
            $this->db->where('eqpSerialNum', $_POST['eqpSerialNum']);
            return $this->db->update('equipment', $data);
        }
        else{
            $data = array(
                'compName' => $_POST['eqpName'],
                'compSerialNum' => $_POST['eqpSerialNum'],                      
                'price' => $_POST['eqpPrice']
            );
             $this->db->where('compSerialNum', $_POST['eqpSerialNum']);
             return $this->db->update('component', $data);
        }
    }

<<<<<<< HEAD
=======
    public function getBorrowEquipments(){
        $this->db->select('*');
        $this->db->from('equipment');
        $this->db->where('eqpSerialNum NOT IN (SELECT eqpSerialNum FROM borrowed_list) AND eqpSerialNum NOT IN (SELECT eqpSerialNum FROM damaged_list)', NULL, FALSE);
        
        $result = $this->db->get()->result_array();

        return $result;
    }

>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
    public function getEquipmentHistory(){
        $eqpSerial = $_POST['equipmentSerialNum'];
        $result = array();

        $this->db->select('D.dateReported, S.studentID, S.studentName');
        $this->db->from('damaged_list D');
        $this->db->join('student S', 'S.studentID = D.damagerIDNum', 'left');
        $this->db->where('D.eqpSerialNum', $eqpSerial);
        $result[] = $this->db->get()->result_array();

        $this->db->select('B.borrowedDate, S.studentID, S.studentName');
        $this->db->from('borrowed_list B');
        $this->db->join('student S', 'S.studentID = B.borrowerIDNum', 'left');
        $this->db->where('B.eqpSerialNum', $eqpSerial);
        $result[] = $this->db->get()->result_array();

        return $result;
    }
<<<<<<< HEAD

    public function getAllItems(){
        $total = 0;

        $this->db->select('count(*) as "totalEqp"');
        $query = $this->db->get('equipment');
        $total += intval($query->result()[0]->totalEqp);

        $this->db->select('count(*) as "totalComp"');
        $query = $this->db->get('component');
        $total += intval($query->result()[0]->totalComp);

        return $total;
    }

    public function getAllLabItems($lab = null){
        $total = 0;

        $this->db->select('count(*) as "totalEqp"');
        $this->db->where('labID', $lab);
        $query = $this->db->get('equipment');
        $total += intval($query->result()[0]->totalEqp);

        $this->db->select('count(*) as "totalComp"');
        $this->db->where('labID', $lab);
        $query = $this->db->get('component');
        $total += intval($query->result()[0]->totalComp);

        return $total;
    }

=======
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
    // end
}
