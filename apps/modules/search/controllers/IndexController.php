<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/11/3
 * Time: 15:45
 */

namespace Apps\Modules\Search\Controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    /**
     * @var array 表关系声明
     * {
     * @var $foreign 外键声明
     * @var $default_join 默认join
     * }
     */
    private $table = [
        'vz_full_user'       => [
            'foreign' => [

            ],
        ],
        'vz_order_detail_tm' => [
            'foreign' => [
                'tid' => 'vz_order_tm_record.tid',
            ]
        ],
        'vz_order_tm_record' => [
            'foreign' => [
                'tid'      => 'vz_order_detail_tm.tid',
                'union_id' => 'vz_full_user.union_id',
            ],
        ],
    ];

    public function index()
    {
        $search = [
            'select' => [
                'vz_full_user.mobile'
            ],
            'search' => [
                [
                    'table' => 'vz_order_detail_tm',
                    'join'  => [
                        'type' => 'LEFT JOIN',
                        'key'  => 'tid',
                    ],
                    'where' => [
                        ['finish_times', '>', 1],
                    ],
                ],
                [
                    'table'  => 'vz_full_user',
                    'join'   => [
                    ],
                    'orWhere'  => [
                        ['sex', '>', 1],
                        'OR'=>['sex', '!=', 1]
                    ],
                    'group'  => [
                        'union_id'
                    ],
                    'having' => [
                        ['count(union_id)', '>', 1],
                    ],
                ],
            ],
        ];
        $sql    = $this->builSql($search);

        dump($sql);
    }

    public function builSql($search)
    {
        // 查询的表
        $first  = $this->getAllJson($search);
        $table  = $first->getData()['table'];
        $select = implode(',', $search['select']);
        $sql    = "SELECT {$select} FROM {$table} ";
        $link   = $first;
        while ($link = $link->next()) {
            $data = $link->getData();
            if ($data['join']) {
                $sql .= $data['join'] . ' ';
            }
        }
        // 条件组装
        $allWhere = $this->getAllWhere($search);
        if ($allWhere) {
            dump($allWhere);
            $strWhere = $this->buildWhere($allWhere);
            dump($strWhere);
            $sql      = $sql . 'WHERE ' . $strWhere;
        }
        // group拼接
        $group = $this->getAllGroup($search);
        if ($group) {
            $sql = $sql . 'GROUP BY ' . implode(',', $group) . ' ';
        }
        // HAVING
        $having = $this->getAllHaving($search);
        if ($having) {
            $sql = $sql . 'HAVING ' . $having;
        }
        return $sql;
    }

    private function getAllHaving($search)
    {
        $list = [];
        foreach ($search['search'] as $sea) {
            if (isset($sea['having']) && $sea['having']) {
                $list[] = $sea['having'];
            }
        }
        if ($list) {
            return $this->buildWhere($list);
        }
        return '';
    }

    private function getAllGroup($search)
    {
        $list = [];
        foreach ($search['search'] as $sea) {
            if (isset($sea['group']) && $sea['group']) {
                foreach ($sea['group'] as &$where) {
                    $where = $sea['table'] . '.' . $where;
                }
                $list = array_merge($sea['group'], $list);
            }
        }
        return $list;
    }

    /**
     * @param $arrAndWhere
     * @param int $level
     * @return string
     */
    private function buildWhere($arrAndWhere,$level=0)
    {
        $where = [];
        foreach ($arrAndWhere as $key => $item) {
            $isOrWhere = strpos($key,'OR')===false?false:true;
            if (is_array(reset($item))) {
                if ($isOrWhere) {
                    $where[] = ['where' => 'OR', 'sql' => $this->buildWhere($item,++$level)];
                } else {
                    $where[] = ['where' => 'AND', 'sql' => $this->buildWhere($item,++$level)];
                }
            } else {
                if ($isOrWhere) {
                    $where[] = ['where' => 'OR', 'sql' => implode(' ', $item)];
                } else {
                    $where[] = ['where' => 'AND', 'sql' => implode(' ', $item)];
                }
            }
        }
        $string = '';
        foreach ($where as $arr) {
            if (!$string) {
                if (count($where) < 2) {
                    $string .= "{$arr['sql']}";
                } else {
                    $string .= "({$arr['sql']}) ";
                }
            } else {
                $string .= "{$arr['where']} ({$arr['sql']}) ";
            }
        }
        return $string;
    }

    public function getAllWhere($search)
    {
        $list   = [];
        $whereKey = 0;
        foreach ($search['search'] as $sea) {
            if (isset($sea['where']) && $sea['where']) {
                foreach ($sea['where'] as &$where) {
                    $where[0] = $sea['table'] . '.' . $where[0];
                }
                $list[++$whereKey.'_AND'] = $sea['where'];
            }elseif (isset($sea['orWhere']) && $sea['orWhere']){
                foreach ($sea['orWhere'] as &$where) {
                    $where[0] = $sea['table'] . '.' . $where[0];
                }
                $list[++$whereKey.'_OR'] = $sea['orWhere'];
            }
        }
        return $list;
    }

    /**
     * 获取所有join
     *
     * @param $search
     * @return Link
     * @throws \Exception
     */
    public function getAllJson($search)
    {
        $list = [];
        foreach ($search['search'] as $sea) {
            if ($sea['join']) {
                // 根据设计的外键拼接json
                if (isset($this->table[$sea['table']]['foreign'][$sea['join']['key']])) {
                    $foreign               = $this->table[$sea['table']]['foreign'][$sea['join']['key']];
                    $list[$sea['table']][] = "{$sea['join']['type']} {$sea['table']} ON {$sea['table']}.{$sea['join']['key']}={$foreign}";

                    // 检查join语句是否有引入新的表
                    $arr = explode('.', $foreign);
                    if (!isset($list[$arr[0]])) {
                        $list[$arr[0]] = [];
                    }
                } else {
                    throw new \Exception('需要配置外键声明' . $sea['join']['key']);
                }
            } elseif (!isset($list[$sea['table']])) {
                $list[$sea['table']] = [];
            }
        }
        // 进行关联排序
        $first = $this->sortJoin($list);
        // 所有已经排序的table
        $link = $first;
        do {
            $table               = $link->getData()['table'];
            $isSortTable[$table] = $table;
        } while ($link = $link->next());
        // 找出还没有排序的table
        $noSort = array_diff(array_keys($list), $isSortTable);
        if (!empty($noSort)) {
            if (count($noSort) > 1) {
                throw new \Exception('需要配置相关外键获取明确指定join链接 : ' . implode(' and ', $noSort));
            } else {
                $lastTable = reset($noSort);
                $data      = $first->getData();
                $table     = $data['table'];
                $linkTable = $this->getTableForJoin($table);
                if (isset($linkTable[$lastTable])) {
                    $data['join'] = $linkTable[$lastTable];
                    $first->setData($data);
                    $link = new Link([
                        'table' => $lastTable,
                        'join'  => '',
                    ]);
                    $link->setNext($first);
                    $first = $link;
                } else {
                    throw new \Exception('需要配置相关外键获取明确指定join链接 :' . $table . ' -> ' . $lastTable);
                }
            }
        }
        return $first;
    }

    /**
     * 对所有表名称进行排序
     *
     * @param $list
     * @return Link
     */
    private function sortJoin($list)
    {
        $first = new Link('header');

        foreach ($list as $table => $arrJoin) {
            foreach ($arrJoin as $join) {
                // 获取join前一步必须的表名
                $arr     = explode('ON', $join);
                $arr     = explode('=', end($arr));
                $table_1 = trim(explode('.', reset($arr))[0]);
                // SQL当中$table_2表必须在$table_1之前出现
                $table_2 = trim(explode('.', end($arr))[0]);
                $link_1  = new Link([
                    'table' => $table_1,
                    'join'  => $join,
                ]);
                $link_2  = new Link([
                    'table' => $table_2,
                    'join'  => '',
                ]);

                if ($first->getData() == 'header') {
                    $first = $link_2;
                    $first->setNext($link_1);
                } else {
                    $link      = $first;
                    $hasTable1 = false;
                    $hasTable2 = false;
                    do {
                        if (($tempTable = $link->getData()['table']) == $table_2) {
                            $hasTable2 = $link;
                        } elseif ($tempTable == $table_1) {
                            $hasTable1 = $link;
                        }
                    } while ($link = $link->next());

                    if (!$hasTable1) {
                        if ($hasTable2) {
                            $next = $hasTable2->next();
                            if ($next) {
                                $link_1->setNext($next);
                            }
                            $hasTable2->setNext($link_1);
                        } else {
                            $link_1->setNext($first);
                            $first = $link_1;
                        }
                    } elseif (!$hasTable1->getData()['join']) {
                        $link_1->setNext($first);
                        $first = $link_1;
                        $next  = $hasTable1->next();
                        $first->setNext($next);
                        unset($next);
                    }
                    if (!$hasTable2) {
                        $link_2->setNext($first);
                        $first = $link_2;
                    } elseif (!$hasTable2->getData()['join']) {
                        $link_2->setNext($first);
                        $first = $link_2;
                        $next  = $hasTable2->next();
                        $first->setNext($next);
                        unset($next);
                    }
                }
            }
        }
        return $first;
    }

    /**
     * 获取表外键所有相关表
     *
     * @param $fromTable
     * @return array
     */
    public function getTableForJoin($fromTable)
    {
        $list = [];
        foreach ($this->table as $table => $arr) {
            if ($table == $fromTable) {
                foreach ($arr['foreign'] as $field => $item) {
                    $temTable        = explode('.', $item)[0];
                    $list[$temTable] = "INNER JOIN {$fromTable} ON {$fromTable}.{$field}=" . $item;
                }
            } else {
                foreach ($arr['foreign'] as $field => $item) {
                    $temTable = explode('.', $item)[0];
                    if ($temTable == $fromTable) {
                        $list[$table] = "INNER JOIN {$fromTable} ON {$fromTable}.{$field}={$table}." . $field;
                    }
                }
            }
        }
        return $list;
    }
}

/**
 * 链对象
 */
class Link
{
    /**
     * @var
     */
    private static $all_link;

    private $data;
    private $next;
    private $key;

    public function __construct($data = 'header')
    {
        $this->data                 = $data;
        $this->key                  = uniqid();
        self::$all_link[$this->key] = $this;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setNext(Link $data)
    {
        $this->next = $data->key;
    }

    public function next()
    {
        return self::$all_link[$this->next] ?? null;
    }
}