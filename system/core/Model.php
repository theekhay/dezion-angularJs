<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {


	protected $table ;


	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}



	/**
	* checks to see if a value exists in this->table for a particular field
	* @param $set {DataType: array, required: true, representation : an array of field-value pair to check }
	* return type - array
	*/
	public function exists($data){

		if(is_array($data) ){

			foreach ($data as $field => $value) {

				$this->db->where($field, $value);
				$query = $this->db->get($this->table);

				if( $query->num_rows() >= 1){

					$data['status'] = TRUE ;
					$data['field']  = $field ;
					
					return $data ;
				} 
			}	

			return $data['status'] = FALSE ;
		}
	}



	
	/**
	* Retreives row data from the model calling it   
	* @param  id {DataType: int, required: true, representation : community id  }
	* @param  field {DataType: varchar, required: false, representation : valid column in $this->table } 
	* Return_type: string OR array.
	*/

	public function get_info($id, $field = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return (! empty($field) ) ? $query->row()->$field : $query->row() ;
	}




	/**
	* Checks if an ID exists in the model calling it.   
	* @param  id {DataType: int, required: true, representation : id  }
	* Return_type: Bool.
	*/

	public function id_exists($id){

		$data = array('id' => $id);
		$query = $this->db->get_where($this->table, $data);
		return ($query->num_rows() >= 1 ) ? true : false;
		
	}



	/**
	* Updates row data on the model calling it. 
	* @param $id 	{DataType: int, required: true, representation :  id }
	* @param $data  {DataType: array, required: true, representation :  update data. }
	* return type - Bool
	*/
 	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return ($this->db->affected_rows() <= 0) ? false : true ;
	}




	/**
	* Deletes row data on the model calling it. 
	* @param $id { DataType : int, required : true, representation : id }
	* return type - Bool
	*/
	// public function drop($id)
	// {
	// 	$data = array('id' => $id);
	// 	$this->db->delete($this->table, $data);
	// 	return ($this->db->affected_rows() <= 0) ? false : true ;
	// }


	public function drop($id, $deleted_by = null )
	{
		//$data = array('deleted' => 1, 'deleted_by' => isset( $deleted_by) ? $deleted_by : $this->session->admin_id, 'date_deleted' => $this->date_time->now('Y-m-d') );
		$data = array('deleted' => 1, 'deleted_by' => isset( $deleted_by) ? $deleted_by : $this->session->admin_id ) ;
		$this->db->where('id', $id) ;
		$this->db->update($this->table, $data);
		return ($this->db->affected_rows() <= 0) ? false : true ;
	}


	public function active($id)
	{
		$data = array('id' => $id);
		$query = $this->db->get_where($this->table, $data);
		return  $query->row()->active  ;
	}



	public function activate($id) //sets a service status(flag) to inactive. as good as deleted.
	{
		$data = array('active' => FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return ($this->db->affected_rows() <= 0) ? false : true ;	
	}





	public function deactivate($id) 
	{
		$data = array('active' => FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return ($this->db->affected_rows() <= 0) ? false : true ;
	}

}
