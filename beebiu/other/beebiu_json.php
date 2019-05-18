<?php 
    $id=0;
    if( isset($_POST['p_filedir']) ){
        $id=1;
    }
    if( isset($_POST['p_dir_list'] ) && $_POST['p_dir_list'] != '' ){
        $id=3;
    }

    switch($id){
        case 1: 
        ?>
        <fieldset>
            <legend>server信息</legend>
                <p style="background-color:#25527C;color:#0ff;padding:4px;">当前路径: <?php echo $_POST['p_filedir']; ?></p>

                <fieldset>
                <legend>图片列表生成模式</legend>
                全动态<input type="radio" name="p_moshi" id="quandongtai" value="1" onclick="change()" />
                静态<input type="radio" name="p_moshi" id="jingtai" value="3" onclick="change()" />
                </fieldset>

                图片url web根路径<br>
                <input id="web_rpath" type="text" name="p_rpath" value="http://img.localhost.com/" style="width:100%;height:30px;background-color:#25527C;color:#ff0;font-size:20px;border:0;padding:4px;" onclick="change()">
                图片url web子路径<br>
                <input id="web_spath" type="text" name="p_spath" value="myimg" style="width:100%;height:30px;background-color:#25527C;color:#ff0;font-size:20px;border:0;padding:4px;" onclick="change()">               

                <fieldset>
                    <legend>web预览</legend>
                    <div class="dir_list_1" style="float:left;">
                        当前选中文件夹 <input type="button" name="tip_img_bt" onclick="submitForm('ajax_form', 'dir_list_2')" value="列出选中文件夹列表" style="width:150px;background-color: #4CAF50;border: none;color: white;padding:15px 15px;text-align: center;text-decoration: none;display: inline-block;">  <br>
                        <input id="dir_list" type="text" name="p_dir_list" value="" style="width:100%;height:30px;background-color:#25527C;color:#f0f;font-size:20px;border:0;padding:4px 10px;" onclick="change()">
                        <select id="select_dir_list" name="select" size="30" onchange="change_2(this.value)">
                            <optgroup label="如果为空，请检查物理路径和php权限"></optgroup>
                            <?php 
                                $file_list=beebiu_scan_dir2( $_POST['p_filedir'] );
                                foreach ($file_list as $value) {
                                    echo '<option value="' . $value . '">' . $value .'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div  id="dir_list_2" style="float:left;"></div>
                    <div id="dir_list_img" style="float:left;">
                        web服务器文件预览<br><img src="" alt="" id="img_web" width="300px" height="auto">
                    </div>
                </fieldset>

        </fieldset>

        <input type="button" name="button" onclick="change()" value="生成json" style="width:100%;background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;">
    <?php 
        break; //case 1 end
        case 3:?>
        选择封面图片<br>
        <input id="web_img" type="text" name="p_web_img" value="" style="width:100%;height:30px;background-color:#25527C;color:#f0f;font-size:20px;border:0;padding:4px 10px;" onclick="change()">
        <select id="select_web_img" name="select" size="30" onchange="change_3(this.value)">
            <optgroup label="目录下文件列表"></optgroup>
            <?php 
                $file_list=beebiu_scan_dir( $_POST['p_filedir']  . '/' . $_POST['p_dir_list'] );
                foreach ($file_list as $value) {
                    echo '<option value="' . $value . '">' . $value .'</option>';
                }
            ?>
        </select>
    <?php 
        break; //case 3 end
        /* case 3: */?>


    
<?php };//switch end ?> 



<?php 
function beebiu_scan_dir($dir){
    $files = array();
    if (is_dir($dir) && $dir != '/') {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
					if(is_dir($dir . "/" . $file) == false){
						//$files[] = $dir . "/" . $file;
						$files[] = $file;
					}
				}
			}
			closedir($handle);
			return $files;
		}
	}
	else{
		echo '不是目录';
	}
}
//beebiu_scan_dir2 列出目录
function beebiu_scan_dir2($dir){
    $files = array();
    if (is_dir($dir) && $dir != '/') {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
					if(is_dir($dir . "/" . $file) == true){
						$files[] = $file;
					}
				}
			}
			closedir($handle);
			return $files;
		}
	}
	else{
		echo '不是目录';
	}
}
?>