<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/10/23
 * Time: 17:40
 */

namespace Apps\Console\Tasks;


use Phalcon\Cli\Task;

class DockerTask extends Task
{
    public function main()
    {
        $this->running();
    }

    private function running()
    {
        $baseCmd = 'docker inspect [name] | grep \'"IPAddress"\'';

        exec('docker ps -a', $arr);

        foreach ($this->getDockerList($arr) as $arrData) {
            $arr = [];
            exec(str_replace('[name]', $arrData['names'], $baseCmd), $arr);
            foreach ($arr as $value) {
                if (isset($value{29})) {
                    $temp = explode(':', trim($value));
                    echo $arrData['names'], $temp[1], "\n";
                }
            }
        }
    }

    private function decodeTitle($str)
    {
        $arrTitleConfig = [];
        $arr            = explode('  ', $str);
        foreach ($arr as $name) {
            if ($name) {
                $arrTitleConfig[$name] = strpos($str, $name);
            }
        }
        $temp      = array_keys($arrTitleConfig);
        $newConfig = [];
        foreach ($temp as $i => $title) {
            if (isset($temp[$i + 1])) {
                $newConfig[$title] = [
                    'start' => $arrTitleConfig[$temp[$i]],
                    'end'   => $arrTitleConfig[$temp[$i + 1]] - 1,
                ];
            } else {
                $newConfig[$title] = [
                    'start' => $arrTitleConfig[$temp[$i]],
                ];
            }
        }
        return $newConfig;
    }

    private function decodeString($arr, $arrTitleConfig)
    {
        $data = [];
        foreach ($arr as $string) {
            $temp = [];
            foreach ($arrTitleConfig as $title => $config) {
                $temp[strtolower(trim($title))] = trim(substr($string, $config['start'], isset($config['end']) ? $config['end'] - $config['start'] : 100));
            }
            $data[] = $temp;
        }
        return $data;
    }

    private function getDockerList($arr)
    {
        $arrTitleConfig = $this->decodeTitle($arr[0]);
        unset($arr[0]);
        return $this->decodeString($arr, $arrTitleConfig);
    }
}