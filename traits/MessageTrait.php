<?php

namespace app\traits;

use Yii;

trait MessageTrait
{
    public function messageImageFailedUpload()
    {
        return Yii::t("action_message", "Telah terjadi kesalahan ketika mengunggah gambar");
    }
    public function message500()
    {
        return Yii::t("action_message", "Telah terjadi kesalahan");
    }

    public function message422($error = null)
    {
        if ($error) $error = " : " . $error;
        return Yii::t("action_message", "Validasi gagal {error}", ["error" => $error]);
    }

    public function message400()
    {
        return Yii::t("action_message", "Request tidak sesuai");
    }

    public function message405()
    {
        return Yii::t("action_message", "Anda tidak memiliki hak akses untuk melakukan tindakan ini");
    }

    public function message404($name = "Data")
    {
        return Yii::t("action_message", "{name} tidak ditemukan", ["name" => $name]);
    }

    public function messageFetchSuccess($name = "Data")
    {
        return Yii::t("action_message", "{name} Berhasil didapatkan", [
            "name" => $name
        ]);
    }

    public function messageCreateSuccess($name = "Data")
    {
        return Yii::t("action_message", "{name} Berhasil dibuat", [
            "name" => $name
        ]);
    }

    public function messageCreateFailed($name = "Data")
    {
        return Yii::t("action_message", "{name} gagal dibuat", [
            "name" => $name
        ]);
    }

    public function messageUpdateSuccess($name = "Data")
    {
        return Yii::t("action_message", "{name} Berhasil diubah", [
            "name" => $name
        ]);
    }

    public function messageUpdateFailed($name = "Data")
    {
        return Yii::t("action_message", "{name} gagal diubah", [
            "name" => $name
        ]);
    }

    public function messageDeleteSuccess($name = "Data")
    {
        return Yii::t("action_message", "{name} Berhasil dihapus", [
            "name" => $name
        ]);
    }

    public function messageDeleteFailed($name = "Data")
    {
        return Yii::t("action_message", "{name} gagal dihapus", [
            "name" => $name
        ]);
    }

    public function message403()
    {
        return Yii::t("action_message", "Anda tidak dapat mengakses menu ini");
    }
}
