<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4 0004
 * Time: 11:26
 */
class PhpexceModel extends Model
{
    //查询说有数据
    public function getAll(){
        //写sql
        $sql="select * from users";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //导出数据表
    public function exce($rows){
        //加载phpexcel
        require './Public/PHPExcel/Classes/PHPExcel.php';
        //创建phpexcel对象
        $objphpexcel=new PHPExcel();
        //添加表单
        $objphpexcel->setActiveSheetIndex(0);
        //设置表单名称
        $objphpexcel->getActiveSheet()->setTitle('users');
        //想表单中添加数据
        //准备表头的名称
        $userinfo=[
            'ID',
            '用户名',
            '密码',
            '真实姓名',
            '年龄',
            '手机号',
            '金额',
            '是否是vip',
            '图片',
            '缩略图'
        ];
        /**
         * 准备表格列名
         */
        $cellName = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ'];
        /**
         * 将表格第一行作为表格的简介行，需要合并
         */
        $count=count($rows);
        $objphpexcel->getActiveSheet()->mergeCells("A1:".$cellName[$count-1].'1');
        //>>3.设置合并后的内容
        $objphpexcel->getActiveSheet()->setCellValue("A1", "用户信息统计  创建时间：" . date("Y-m-d"));
        /**
         * 表格第二行开始设置表头
         */
        foreach ($userinfo as $k => $v) {
            $objphpexcel->getActiveSheet()->setCellValue($cellName[$k] . "2", $v);
        }

        /**
         * 表格第三行开始添加表格数据
         */
        foreach ($rows as $k => $v) {
            //获取当前多少行
            $line = 3 + $k;
            $i = 0;
            foreach ($v as $key => $value) {
                $objphpexcel->getActiveSheet()->setCellValue($cellName[$i] . $line, $value);
                ++$i;
            }
        }
        //导出excel
        $xlsname = iconv("utf-8", "gb2312", "用户信息表");

// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsname . '.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objphpexcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
}