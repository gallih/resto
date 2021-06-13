<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_grafik extends Ci_Model{
  
 function laporan($tabel ,$tahun)
 {
   
  $bc = $this->db->query("  
  select
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=1)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Januari`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=2)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Februari`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=3)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Maret`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=4)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `April`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=5)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Mei`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=6)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Juni`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=7)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Juli`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=8)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Agustus`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=9)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `September`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=10)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Oktober`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=11)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `November`,
  ifnull((SELECT sum(gtot) FROM (".$tabel.")WHERE((Month(tgl)=12)AND (YEAR(tgl)=".$tahun."))and sts='sudah' and trans='Y'),0) AS `Desember`
 from ".$tabel." GROUP BY YEAR(tgl) 
   
  ");
   
  return $bc;
   
 }
  
  
}
?>