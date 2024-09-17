<?php
    function GetDetailData($Conn,$Tabel,$Param,$Value,$Colom){
        if(empty($Conn)){
            $Response="No Database Connection";
        }else{
            if(empty($Tabel)){
                $Response="No Table Selected";
            }else{
                if(empty($Param)){
                    $Response="No Parameter Selected";
                }else{
                    if(empty($Value)){
                        $Response="No Value Count";
                    }else{
                        if(empty($Colom)){
                            $Response="No Colom Selected";
                        }else{
                            $Qry = mysqli_query($Conn,"SELECT * FROM $Tabel WHERE $Param='$Value'")or die(mysqli_error($Conn));
                            $Data = mysqli_fetch_array($Qry);
                            if(empty($Data[$Colom])){
                                $Response="";
                            }else{
                                $Response=$Data[$Colom];
                            }
                        }
                    }
                }
            }
        }
        return $Response;
    }
    function validateAndSanitizeInput($input) {
        // Menghapus karakter yang tidak diinginkan
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
?>