<?php


if( !function_exists('fs_tipos_id_fiscal') )
{
   /**
    * Devuelve la lista de identificadores fiscales.
    * @return type
    */
   function fs_tipos_id_fiscal()
   {
      return array(FS_CIFNIF,'R.U.C','Pasaporte');
  }
  
}