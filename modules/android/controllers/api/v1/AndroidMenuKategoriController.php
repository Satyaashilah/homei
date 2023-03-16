<?php

namespace app\modules\android\controllers\api\v1;

/**
 * This is the class for REST controller "AndroidMenuKategoriController".
 * Modified by Defri Indra
 */

use app\modules\android\models\AndroidMenu;
use app\modules\android\models\AndroidMenuKategori;
use Yii;

class AndroidMenuKategoriController extends \app\modules\api\controllers\BaseController
{
    public $modelClass = 'app\modules\android\models\AndroidMenuKategori';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $parent = parent::behaviors();
        // $parent['authentication'] = [
        //     "class" => "\app\components\CustomAuth",
        //     "except" => ["index"]
        // ];

        return $parent;
    }


    public function actionIndex()
    {
        $modelKategoriParent = AndroidMenuKategori::find()->where(['is', 'id_reference', null])->asArray()->all();
        $modelMenuParent = AndroidMenu::find()->where(['is', 'id_category', null])->asArray()->all();

        $template = [];
        $key_menu = 0;
        foreach ($modelKategoriParent as  $item) {
            $modelKategoriParent = AndroidMenuKategori::find()->where(['=', 'id_reference', $item['id']])->select("*, concat('kategori') as what_is")->asArray()->all();
            $modelMenuParent = AndroidMenu::find()->orderBy(['order' => SORT_ASC])->select("*, concat('menu') as what_is")->where(['=', 'id_category', $item['id']])->asArray()->all();

            $data_list = array_merge($modelKategoriParent, $modelMenuParent);
            usort($data_list, "static::my_cmp");

            if (count($data_list) == 0) {
                foreach ($data_list as $_item) {
                    if ($_item['what_is'] == 'menu') {
                        // foreach ($modelMenuParent as $_item) {
                        $boolean_standart_value = ['true', 'false'];
                        $additioinal_params = (array)json_decode($_item['params']);
                        // dd($additioinal_params);

                        // apakah terjadi kesalahan ketika decode json 
                        if (json_last_error_msg() !== "No error") {
                            $additioinal_params = [];
                        }

                        // convert nilai dari setiap json ke type data lain
                        foreach ($additioinal_params as $key => $__item) {
                            if (in_array($__item, $boolean_standart_value)) {
                                settype($__item, "boolean");
                            } else if (is_numeric($__item)) {
                                settype($__item, "integer");
                            }

                            $additioinal_params[$key] = $__item;
                        }

                        $params = array_merge([
                            "icon" => [
                                "uri" => Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@web/uploads/no-image.png"))
                            ],
                        ], $additioinal_params);
                        $template[$key_menu]['menu'][] = [
                            "icon" => \Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@file/no-image.png")),
                            "label" => $_item['label'],
                            "name" => $_item["name"],
                            "navigation" => $_item['navigation'],
                            "need_login" => $_item['need_login'],
                            "params" => $params,
                            "type" => $_item['type'],
                        ];
                    } else if ($_item['what_is'] == 'kategori') {
                        // foreach ($modelKategoriParent as $_item) {
                        $template[$key_menu]['menu'][] = [
                            "icon" => \Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@file/no-image.png")),
                            "label" => $_item['category_name'],
                            "name" => $_item["category_name"],
                            "navigation" => $_item['navigation'],
                            "need_login" => 0,
                            "params" => null,
                            "children" => $this->generateNested($_item['id'], $_item["category_name"], "kategori"),
                            "type" => "nested",
                        ];
                    }
                }
            }
            //  else {
            //     $template[$key_menu]["menu"] = [];
            // }


            $template[$key_menu]["category_name"] = $item["category_name"];
            $key_menu++;
        }

        return $template;
    }

    function my_cmp($a, $b)
    {
        if ($a['order'] == $b['order']) {
            return 0;
        }
        return ($a['order'] < $b['order']) ? -1 : 1;
    }

    public function generateNested($id, $category_name, $type = null)
    {
        if ($type == "kategori") {
            $modelKategoriParent = AndroidMenuKategori::find()->where(['=', 'id_reference', $id])->select("*, concat('kategori') as what_is")->asArray()->all();
            $modelMenuParent = AndroidMenu::find()->orderBy(['order' => SORT_ASC])->where(['=', 'id_category', $id])->select("*, concat('menu') as what_is")->asArray()->all();
        } else {
            $modelKategoriParent = [];
            $modelMenuParent = [];
        }


        if ($modelKategoriParent == [] && $modelMenuParent == []) {
            return null;
        }

        $template = [];
        $key_menu = 0;

        $data_list = array_merge($modelKategoriParent, $modelMenuParent);
        usort($data_list, "static::my_cmp");


        foreach ($data_list as $_item) {
            if ($_item['what_is'] == 'menu') {
                $boolean_standart_value = ['true', 'false'];
                $additioinal_params = (array)json_decode($_item['params']);
                // dd($additioinal_params);

                // apakah terjadi kesalahan ketika decode json 
                if (json_last_error_msg() !== "No error") {
                    $additioinal_params = [];
                }

                // convert nilai dari setiap json ke type data lain
                foreach ($additioinal_params as $key => $__item) {
                    if (in_array($__item, $boolean_standart_value)) {
                        settype($__item, "boolean");
                    } else if (is_numeric($__item)) {
                        settype($__item, "integer");
                    }

                    $additioinal_params[$key] = $__item;
                }

                $params = array_merge([
                    "icon" => [
                        "uri" => Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@web/uploads/no-image.png"))
                    ],
                ], $additioinal_params);
                $template[$key_menu]['menu'][] = [
                    "icon" => \Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@file/no-image.png")),
                    "label" => $_item['label'],
                    "name" => $_item["name"],
                    "navigation" => $_item['navigation'],
                    "need_login" => $_item['need_login'],
                    "params" => $params,
                    "type" => $_item['type'],
                ];
            } else if ($_item['what_is'] == 'kategori') {
                $template[$key_menu]['menu'][] = [
                    "icon" => \Yii::$app->formatter->asFileLink($_item['icon'], Yii::getAlias("@file/no-image.png")),
                    "label" => $_item['category_name'],
                    "name" => $_item["category_name"],
                    "navigation" => $_item['navigation'],
                    "need_login" => 0,
                    "params" => null,
                    "children" => $this->generateNested($_item['id'], $_item["category_name"], "kategori"),
                    "type" => "nested",
                ];
            }
        }

        $template[$key_menu]["category_name"] = $category_name;
        $key_menu++;

        return $template;
    }
}
