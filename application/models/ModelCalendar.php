<?php

class ModelCalendar extends CI_Model
{
	
public function get_events($start, $end)
{
    return $this->db->where("start >=", $start)->where("end <=", $end)->get("events");
}

public function add_event($data)
{
    $this->db->insert("events", $data);
}

public function get_event($id)
{
    return $this->db->where("ID", $id)->get("events");
}

public function update_event($id, $data)
{
    $this->db->where("ID", $id)->update("events", $data);
}

public function delete_event($id)
{
    $this->db->where("ID", $id)->delete("events");
}

}
