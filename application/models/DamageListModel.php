<?php

class DamageListModel extends CI_Model {
    

    public $damagerIDNum;
    public $labID;
    public $compSerialNum;
    public $eqpSerialNum;
    public $teacher;
    
	function __construct(){
        parent::__construct();
    }


    public function addDamageEquipments(){
        $return = array();
        foreach ($_POST['equipment'] as $equipment) {
           $this->damagerIDNum = $_POST['damagerID']; 
           $this->eqpSerialNum = $equipment;
           $this->teacher = $_POST['damagerTeacher'];
           $return[] = $this->db->insert('damaged_list',$this);
        }
        return $return;
    }

    public function getDamageEquipmentList(){

<<<<<<< HEAD

      $this->db->select("D.compSerialNum,D.eqpSerialNum,D.dateReported, E.eqpName");
      $this->db->from('damaged_list D');
      $this->db->join('equipment E', 'E.eqpSerialNum = D.eqpSerialNum', 'left');

=======
      $this->db->select("compSerialNum,eqpSerialNum,dateReported");
      $this->db->from('damaged_list');
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
      $result = $this->db->get()->result_array();

      return $result;

      // $list = $this->db->get('damaged_list');
      // return $list->result();
    }

    public function repairEquipments(){
<<<<<<< HEAD
        $result = array();
        foreach ($_POST['equipment'] as $equipment) {
            $this->db->from('damaged_list');
            $this->db->where('eqpSerialNum', $equipment);
            $result[] = $this->db->delete();    
        }
        return $result;
=======
        foreach ($_POST['equipment'] as $equipment) {
            $this->db->set('isRepaired', 1);
            $this->db->where('eqpSerialNum', $equipment);
            return $this->db->update('damaged_list');    
        }
>>>>>>> Modified 1/03/2017 Validations+Bug Fixes
    }
}
