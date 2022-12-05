<?php
/**
 * FolderInfo Class
 *
 * This class is free for the educational use as long as maintain this header together with this class.
 * Author: Win Aung Cho
 * Contact winaungcho@gmail.com
 * version 1.0
 * Date: 4-12-2022
 */
class FolderInfo
{
	
	public function __construct(){
		$this->viewable = array("txt","css","js","json","inc","xml","png","jpg","jpeg","gif","bmp","tif","ico","mp3","mp4","wav","svg");
	}
	
    private function sum_merge($org, $subArray)
    {

        foreach ($subArray as $id => $value)
        {
            if (!isset($org[$id])) $org[$id] = $value;
            else
            {
                $org[$id]['n'] += $value['n'];
                $org[$id]['s'] += $value['s'];
            }
        }
        return $org;
    }
    
    public function dirsize($dir)
    {
        $i = 0;
        $s = 0;
        $exts = [];
        $html = "<li><span>$dir</span>";
        $html .= "<ul>";
        if ($handle = opendir($dir))
        {
            while (($file = readdir($handle)) !== false)
            {
                if (!in_array($file, array(
                    '.',
                    '..'
                )))
                {
                    if (is_dir($dir . $file))
                    {
                        $info = $this->dirsize($dir . $file . "/");
                        $i += $info["n"];
                        $s += $info["s"];
                        $html .= $info["html"];
                        $exts = $this->sum_merge($exts, $info["e"]);
                    }
                    else
                    {
                        $ext = end(explode(".", $file));
                        $fs = filesize($dir . $file);
                        if (!isset($exts[$ext])) $exts[$ext] = array(
                            "n" => 1,
                            "s" => $fs
                        );
                        else
                        {
                            $exts[$ext]["n"] += 1;
                            $exts[$ext]["s"] += $fs;
                        }
                        $s += $fs;
                        $i++;
                        if (in_array($ext, $this->viewable))
                        	$html .= "<li><a href='".$dir . $file."'>" . $file . "</a></li>";
                        else
                        	$html .= "<li>" . $file . "</li>";
                    }

                }

            }
        }
        $html .= "</ul>";
        $html .= "</li>";
        return array(
            "n" => $i,
            "s" => $s,
            "e" => $exts,
            "html" => $html
        );
    }
    
    public function printAll()
    {
        $dir = "./";
        $info = $this->dirsize($dir);
        echo "Total Files: " . $info["n"];
        echo "<br/>";
        echo "Total Size: ".number_format($info["s"]/1024/1024,2,'.', ',')."Mb";
        echo "<br/>";
        echo "<ul class='collapse'>";
        echo $info["html"];
        echo "</ul>";

        echo "<table>";
        echo "<tr><th>Type</th><th>Count</th><th>Size (kb)</th></tr>";
        foreach ($info["e"] as $id => $value)
        {
            echo "<tr><td>$id</td><td align='right'>" . $value['n'] . "</td><td align='right'>" . number_format($value['s']/1024, 2, '.', ',') . "</td></tr>";
        }
        echo "</table>";
    }
}
?>
