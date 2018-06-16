<?php
namespace Api\Model;
use Think\Model;

class BaseModel extends Model {

  /**
   * 添加数据
   * @param   array $data 新增数据
   * @param   int 新增数据 Id
   */

  public function addData($data){
    if(empty($data['id'])) {
        $data['id'] = 1;
    }
    $id=$this->add($data);
    if($id) {
        return 1;
    }else {
        return false;
    }
  }

  /**
   * 修改数据
   * @param    array    $map    where语句数组形式 
   * @param    array    $data  修改的数据 
   * @return    boolean         操作是否成功
   */
  public function editData($map, $data) {
    $data['updatetime'] = date('Y-m-d H:i:s', time());
    unset($data['id']);
    $result=$this->where($map)->save($data);
    return $result;
  }

  /**
   * 删除数据
   * @param    array    $map    where语句数组形式
   * @return   boolean          操作是否成功
   */
  public function deleteData($map){
    $result=$this->where($map)->delete();
    return $result;
  }
  
  // 主键查询
  public function getById($id){
    $data = $this->where('id=\''.($id).'\'')->find();
    // 字段过滤
    unset($data['adduserid']);unset($data['addtime']);
    unset($data['edittime']);unset($data['addby']);
    unset($data['updateby']);unset($data['updatetime']);
    //  unset($data['state']);unset($data['status']);
    return $data;
  }
  
  // 分页查询
  public function getByPage($page,$map= []){
    if(!isset($page['pageSize'])){
        $page['pageSize'] = 10;
    }
    if(!isset($page['pageNum'])){
        $page['pageNum'] = 1;
    }
    $count      = $this->where($map)->count();// 查询满足要求的总记录数
    $Page       = new \Think\Page($count,$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    $list = $this->where($map)->order('addtime')->limit((($page['pageNum']-1)*10).','.$page['pageSize'])->select();
    $res = array(
        'list' => $list,
        'page' => $Page,
    );
    return $res;
  }
}