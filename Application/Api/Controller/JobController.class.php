<?php
namespace Api\Controller;
use Think\Controller;

class JobController extends Controller {
  public function getList() {
    $arr = [1,2,3,4];
    $this->ajaxReturn(array(
      'status' => 0,
      'list' => $arr
    ));
  }

  public function add() {
    $params = json_decode(file_get_contents('php://input'));
    $this->ajaxReturn(array(
      'status' => 0,
      'data' => $params
    ));
  }

  public function del() {
    $id = json_decode(file_get_contents('php://input'));
    var_dump($id); die;
  }
}
