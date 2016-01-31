<?php

namespace app\modules\users\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * @method getImageSrc($size = null)
 * @property string $imageSrc
 */
class Profile extends \dektrium\user\models\Profile
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            'imageUploaderBehavior' => [
//                'class' => 'demi\image\ImageUploaderBehavior',
//                'imageConfig' => [
//                    // Name of image attribute where the image will be stored
//                    'imageAttribute' => 'image',
//                    // Yii-alias to dir where will be stored subdirectories with images
//                    'savePathAlias' => '@avatars',
//                    // Yii-alias to root project dir, relative path to the image will exclude this part of the full path
//                    'rootPathAlias' => '@app/web',
//                    // Name of default image. Image placed to: webrooot/images/{noImageBaseName}
//                    // You must create all noimage files: noimage.jpg, medium_noimage.jpg, small_noimage.jpg, etc.
//                    'noImageBaseName' => 'noimage.jpg',
//                    // List of thumbnails sizes.
//                    // Format: [prefix=>max_width]
//                    // Thumbnails height calculated proportionally automatically
//                    // Prefix '' is special, it determines the max width of the main image
//                    'imageSizes' => [
//                        '' => 10000,
//                        'lg_' => '640',
//                        'md_' => '250',
//                        'sm_' => '100',
//                        'xs_' => '50',
//                    ],
//                    // This params will be passed to \yii\validators\ImageValidator
//                    'imageValidatorParams' => [
//                        'minWidth' => 400,
//                        'minHeight' => 300,
//                    ],
//                    // Cropper config
//                    'aspectRatio' => 4 / 3, // or 16/9(wide) or 1/1(square) or any other ratio. Null - free ratio
//                    // default config
//                    'imageRequire' => false,
//                    'fileTypes' => 'jpg,jpeg,gif,png',
//                    'maxFileSize' => 10485760, // 10mb
//                    // If backend is located on a subdomain 'admin.', and images are uploaded to a directory
//                    // located in the frontend, you can set this param and then getImageSrc() will be return
//                    // path to image without subdomain part even in backend part
//                    'backendSubdomain' => 'admin.',
//                ],
//            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'bioString' => ['bio', 'string'],
            'publicEmailPattern' => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl' => ['website', 'url'],
            'nameLength' => ['name', 'string', 'max' => 255],
            'publicEmailLength' => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength' => ['gravatar_email', 'string', 'max' => 255],
            'locationLength' => ['location', 'string', 'max' => 255],
            'websiteLength' => ['website', 'string', 'max' => 255],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('user', 'Name'),
            'public_email' => Yii::t('user', 'Email (public)'),
            'gravatar_email' => Yii::t('user', 'Gravatar email'),
            'location' => Yii::t('user', 'Location'),
            'website' => Yii::t('user', 'Website'),
            'bio' => Yii::t('user', 'Bio'),
            'image' => Yii::t('user', 'Picture')
        ];
    }

}
