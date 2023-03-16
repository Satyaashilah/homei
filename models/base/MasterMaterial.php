<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build
// Modified by Defri Indra
// 2021

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "t_master_material".
 *
 * @property string $nama
 * @property string $deskripsi
 * @property integer $id_satuan
 * @property integer $flag
 * @property integer $id
 *
 * @property \app\models\MasterSatuan $satuan
 * @property string $aliasModel
 */
abstract class MasterMaterial extends \yii\db\ActiveRecord
{
    /**
     * BaseModel rules. 
     **/
    use \app\traits\ModelTrait;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $_render = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_master_material';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \app\components\behaviors\UUIDBehavior::class,
                'model' => get_called_class(),
                'primaryKey' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'deskripsi', 'id_satuan'], 'required'],
            [['deskripsi'], 'string'],
            [['id_satuan', 'flag'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\MasterSatuan::class, 'targetAttribute' => ['id_satuan' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'nama' => Yii::t('models', 'Nama'),
            'deskripsi' => Yii::t('models', 'Deskripsi'),
            'id_satuan' => Yii::t('models', 'Satuan'),
            'flag' => Yii::t('models', 'Flag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(\app\models\MasterSatuan::class, ['id' => 'id_satuan']);
    }





    public function scenarios()
    {
        $parent = parent::scenarios();

        $columns = [
            'id',
            'nama',
            'deskripsi',
            'id_satuan',
            'flag',
        ];

        $parent[static::SCENARIO_CREATE] = $columns;
        $parent[static::SCENARIO_UPDATE] = $columns;
        return $parent;
    }

    /**
     * @inheiritance
     */
    public function fields()
    {
        $parent = parent::fields();

        if(isset($parent['id'])) :
            unset($parent['id']);
            $parent['id'] = function($model) {
                return $model->id;
            };
        endif;
        if(isset($parent['nama'])) :
            unset($parent['nama']);
            $parent['nama'] = function($model) {
                return $model->nama;
            };
        endif;
        if(isset($parent['deskripsi'])) :
            unset($parent['deskripsi']);
            $parent['deskripsi'] = function($model) {
                return $model->deskripsi;
            };
        endif;
        if(isset($parent['id_satuan'])) :
            unset($parent['id_satuan']);
            $parent['id_satuan'] = function($model) {
                return $model->id_satuan;
            };
            $parent['_satuan'] = function($model) {
                $rel = $model->satuan;
                if ($rel) :
                    return $rel;
                endif;
                return null;
            };
        endif;
        if(isset($parent['flag'])) :
            unset($parent['flag']);
            $parent['flag'] = function($model) {
                return $model->flag;
            };
        endif;



        return $parent;
    }


    public static function faker($count = 10){
        $faker= \Faker\Factory::create();
        $faker->addProvider(new \app\components\faker\provider\MyImage($faker));
        $data = [];
        $maxId = static::find()->max('id');

        // relational data
        // $relationalsatuan = \app\components\Constant::getIDs(\app\models\MasterSatuan::class, ['id' => 'id_satuan']);::find()->select('id')->all(), 'id');
        for ($i = 0; $i < $count; $i++) {
            $data[] = [ 
                "nama" => $faker->name,
                "deskripsi" => $faker->paragraphs($nb = 3, $asText = true),
                "id_satuan" => \app\components\Constant::getRandomFrom($relationalsatuan),
                "flag" => $faker->numberBetween(0, 1),
                "id" => $faker->unique()->numberBetween($maxId, $maxId + $count),
            ];
        }
        return $data;
    }

}
