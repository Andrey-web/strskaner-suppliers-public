<?php

namespace frontend\controllers;

use Exception;
use frontend\models\BaseRpManufacturer;
use frontend\models\Dadata;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\RpAddress;
use frontend\models\RpPayment;
use frontend\models\VerifyEmailForm;
use http\Header;
use yii\web\HttpException;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\RpManufacturer;
use frontend\models\ConfirmManufacturer;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->get('companyType')) {
            $companyType = Yii::$app->request->get('companyType');
            return $this->redirect(
                ['registration', 'companyType' => $companyType]
            );
        }
        $this->layout = 'main-index';
        return $this->render('index');
    }

//    public function actionTest()
//    {
//        $message = 'Код подтверждения для регистрации на сайте stroyru.ru: ' . 1234;
//        $phone = '+79206513266';
//
//        $param = [
//            'channelType' => "SMS",
//            "senderName" => "StroyRu",
//            "destination" => $phone,
//            "content" => $message,
//            "ttl" => 43200,
//            "useLocalTime" => true,
//            "tags" => ["tag1","tag2"]
//        ];
//
//        $param_json = json_encode([$param], true);
//
///*        print_r($param_json); exit;
//
//        $param_json = '[{
//        "channelType":"SMS",
//        "senderName":"StroyRu",
//        "destination":"+79206513266",
//        "content":"Проверка",
//        "useLocalTime":true,"ttl":43200,
//        "tags":["tag1","tag2"]}]';*/
//
//
//        $href = 'https://direct.i-dgtl.ru/api/v1/message';
//        $ch = curl_init();
//        $headers = [
//            'Content-Type: application/json',
//            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqdm1fYmFja2VuZCIsInN1YiI6IjM0NiIsImNsaWVudF9pZCI6MzA1ODQsInR5cGUiOiJhY2Nlc3MiLCJnZW4iOjEsImdlbmVyYXRlZF9ieSI6MzIxLCJuYW1lIjoi0JjQvdCz0LAg0JPRgNGD0L_QvyIsImlhdCI6MTYyMDEzODcyOSwiZXhwIjo5MjIzMzcyMDM2ODU0Nzc1fQ.fxYciRgTy6SoWOVA6MeDctugA6OA58uQFyk5WKdgiaA',
//        ];
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_json);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
//        curl_setopt($ch, CURLOPT_URL, $href);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        $res = curl_exec($ch);
//        $result = json_decode($res, true);
//        curl_close($ch);
//
//        var_dump($result); exit;
//
//
////        `curl --location --request POST 'https://direct.i-dgtl.ru/api/v1/message/' \
////        --header 'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqdm1fYmFja2VuZCIsInN1YiI6IjM0NiIsImNsaWVudF9pZCI6MzA1ODQsInR5cGUiOiJhY2Nlc3MiLCJnZW4iOjEsImdlbmVyYXRlZF9ieSI6MzIxLCJuYW1lIjoi0JjQvdCz0LAg0JPRgNGD0L_QvyIsImlhdCI6MTYyMDEzODcyOSwiZXhwIjo5MjIzMzcyMDM2ODU0Nzc1fQ.fxYciRgTy6SoWOVA6MeDctugA6OA58uQFyk5WKdgiaA' \
////        --header 'Content-Type: application/json' \
////        --data-raw '[{
////        "channelType":"SMS",
////        "senderName":"StroyRu",
////        "destination":"+79206513266",
////        "content":"Проверка",
////        "useLocalTime":true,"ttl":43200,
////        "tags":["tag1","tag2"]}]'`;
//    }

    /**
     *
     * @throws HttpException
     */
    public function actionRegistration()
    {
        $this->layout = 'registration';
        $companyType = Yii::$app->request->get('companyType') ??  Yii::$app->request->post('companyType');

        $viewTemplates = [
            1 => 'registration_buyer',
            2 => 'registration_partner',
            4 => 'registration',
        ];

        // Проверка допустимого типа компании
        if (!isset($viewTemplates[$companyType])) {
            exit('Недоступно');
        }

        $viewFile = $viewTemplates[$companyType];

        $company = new BaseRpManufacturer();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $postData = $request->post();

            $companyInn = $postData['inn'];

            // Проверяем, существует ли компания с таким ИНН
            if (!empty($companyInn)) {
                $existingCompany = BaseRpManufacturer::find()->where(['inn' => $postData['inn']])->exists();
                if ($existingCompany) {
                    throw new HttpException(400, 'Организация с таким ИНН уже зарегистрирована');
                }
            }

            $transaction = Yii::$app->db->beginTransaction(); // Начало транзакции

            try {
                $company = new BaseRpManufacturer();

                $companyShortName = $postData['name'];
                $companyName = $postData['full-name'];
                $companyType = $postData['companyType'];
                if ($postData['fio-check'] == 'on') {
                    $companyShortName = $postData['fio'];
                    $companyName = $postData['fio'];
                    $companyType = 3;
                }
                $company->companyShortName = $companyShortName;
                $company->inn = $postData['inn'];
                $company->companyName = $companyName;
                $company->manufacturerAddressUr = $postData['legal-address'];
                $existingEmail = BaseRpManufacturer::find()->where(['companyEmail' => $postData['email']])->exists();
                if ($existingEmail) {
                    throw new HttpException(400, 'Организация с таким Email уже зарегистрирована');
                } else {
                    $company->companyEmail = $postData['email'];
                }
                $company->companySite = $postData['site'];
                $company->manufacturerAdressFact = $postData['address'];
                $company->companyType = $companyType;
                $company->phone = $postData['phone'];
                $company->date = date('Y-m-d H:i:s');
                $company->status = RpManufacturer::STATUS_LANDING;

                if (!$company->save()) {
                    throw new Exception('Ошибка сохранения компании: ' . json_encode($company->errors));
                }

                $newCompanyId = $company->id; // ID новой компании

                // Проверяем, есть ли данные о карьерах и является ли это массивом
                if (!empty($postData['quarries']) && is_array($postData['quarries'])) {
                    foreach ($postData['quarries'] as $quarry) {
                        if (!empty($quarry)) {
                            $address = new RpAddress();
                            $address->companyId = $newCompanyId;
                            $address->address = trim($quarry['address']);
                            $address->name = $quarry['name'];
                            $address->index = 1;

                            if (!$address->save()) {
                                throw new Exception('Ошибка сохранения адреса: ' . json_encode($address->errors));
                            }
                        }
                    }
                }
                $paymentType = new RpPayment();
                $paymentType->companyId = $newCompanyId;
                if (!empty($postData['payment-nds'])) {
                    $paymentType->nds = 1;
                }
                if (!empty($postData['payment-without-nds'])) {
                    $paymentType->cashless = 1;
                }
                if (!empty($postData['payment-card'])) {
                    $paymentType->creditCard = 1;
                    $paymentType->cash = 1;
                }
                if (!empty($postData['payment-receipt'])) {
                    $paymentType->receipt = 1;
                }
                $paymentType->save();

                $transaction->commit(); // Подтверждаем транзакцию
                return $this->asJson([
                    'success' => true,
                    'message' => 'Компания успешно зарегистрирована'
                ]);

            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->response->statusCode = 400; // Устанавливаем код ошибки (Bad Request)
                return $this->asJson([
                    'success' => false,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $this->render($viewFile, [
            'companyType' => $companyType,
            'company' => $company,
        ]);
    }

    /**
     *
     */
    public function actionStepModal()
    {
        return $this->render('step-modal');
    }
    public function actionStep2()
    {
        //$this->enableCsrfValidation = false;
        $model = new RpManufacturer();
        $model->status = RpManufacturer::STATUS_LANDING_NOT_CONFIRMED;
/*        $model->representative = 0;
        $model->ownership = '';
        $model->founders = '';
        $model->yearOfRegistration = '';
        $model->companyName = '';
        $model->companyShortName = '';
        $model->ogrn = '';
        $model->kpp = '';*/

        $post = Yii::$app->request->post();

/*        if($post){
            print_r($post);
            exit;
        }*/

        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post(), '') ) {

            $result = Dadata::getObject($model->inn);
            $model->companyName = $result['nameFullWithOpf'] ?? $result['nameShotWithOpf'];
            $model->companyShortName = $result['nameShotWithOpf'] ?? $result['nameFullWithOpf'];
            $model->ogrn = $result['ogrn'];
            $model->okved = $result['okved'];
            $model->companyType = Yii::$app->request->post('companyType');

            if($model->save()){
                $modelConfirmManufacturer = new ConfirmManufacturer();
                $modelConfirmManufacturer->manufacturer_id = $model->id;
                //$modelConfirmManufacturer->code = rand(1000, 9999);
                $modelConfirmManufacturer->code = 3333;
                if(!$modelConfirmManufacturer->save()){
                    print_r($modelConfirmManufacturer->getErrors());
                    exit;
                }
                return $this->redirect([
                    'step3',
                    'id' => $modelConfirmManufacturer->id,
                ]);
            }
        }
        $companyType = Yii::$app->request->get('companyType');
        return $this->render('step2', [
            'model' => $model,
            'companyType' => $companyType,
        ]);
    }

    /**
     * Проверка правильности полей
     */
    public function actionValidate()
    {
        $model = new RpManufacturer();
        $model->status = RpManufacturer::STATUS_LANDING_NOT_CONFIRMED;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post(), '')) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $arrRes = [];
            $arr = ActiveForm::validate($model);
            foreach ($arr as $key => $value){
                $index = str_replace('rpmanufacturer-', '', $key);
                $arrRes[$index] = $value;
            }
            return $arrRes;
        }
    }

    /**
     * Проверка наличия уже такой организации
     */
    public function actionExist()
    {
        //TODO при подключении смс подтверждения - раскомментировать
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $inn = ArrayHelper::getValue($post, 'inn');
        $res = RpManufacturer::find()
            ->andWhere([
                'inn' => $inn,
            ])
//            ->andWhere([
//                'not',
//                [
//                    'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED,
//                ],
//            ])
            ->exists();
        return [
            'result' => !$res,
        ];
    }

    /**
     *
     */
    public function actionStep3($id)
    {
        $model = ConfirmManufacturer::find()
            ->andWhere([
                'id' => $id,
                'status' => null,
            ])
            ->orderBy([
                'id' =>SORT_DESC
            ])
            ->one();
        if($model){
            if ($model->load(Yii::$app->request->post(), '')) {
                $model->status = 1;
                if($model->save()){
                    return $this->redirect(['step4']);
                }
/*                else{
                    print_r($model->getErrors()); exit;
                }*/

            }

            $name = RpManufacturer::find()
                ->select([
                    'companyName',
                ])
                ->andWhere([
                    'id' => $model->manufacturer_id,
                ])
                ->scalar();

            return $this->render('step3',[
                'model' => $model,
                'name' => $name,
            ]);
        }
        else{
            return $this->redirect(['step2']);
        }
    }

    public function actionCheck()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $res = 0;
        $post = Yii::$app->request->post();
        $id = ArrayHelper::getValue($post, 'id');
        $code = ArrayHelper::getValue($post, 'code');
        if($code){
            $model = ConfirmManufacturer::find()
                ->andWhere([
                    'id' => $id,
                    'status' => null,
                ])
                ->orderBy([
                    'id' =>SORT_DESC
                ])
                ->one();
            if($model){
                $model->codeCheck = $code;

                if($model->save()){
                    $res = 1;
                }
/*                else{
                    var_dump($model->code);
                    var_dump($model->codeCheck);
                    print_r($model->getErrors());
                    exit;
                }*/
            }
        }
        return ['result' => $res];
    }

    /**
     * Повторная отправка СМС
     */
    public function actionSendCodeAjax()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $res = 0;
        $post = Yii::$app->request->post();
        $id = ArrayHelper::getValue($post, 'id');
        if($id){
            $idRpManufacturer = ConfirmManufacturer::find()
                ->select([
                    'manufacturer_id'
                ])
                ->andWhere([
                    'id' => $id,
                ])
                ->scalar();
            if($idRpManufacturer){
                //Проверим есть ли неподтвержденный поставщик
                $model = RpManufacturer::find()
                    ->andWhere([
                        'id' => $idRpManufacturer,
                        'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED,
                    ])
                    ->one();
                if($model){
                    //Создаем новое подтверждение
                    $modelConfirmManufacturer = new ConfirmManufacturer();
                    $modelConfirmManufacturer->manufacturer_id = $model->id;
                    //$modelConfirmManufacturer->code = rand(1000, 9999);
                    $modelConfirmManufacturer->code = 3333;
                    if($modelConfirmManufacturer->save()){
                        $res = $modelConfirmManufacturer->id;
                    }
                }
            }

        }
        return ['result' => $res];
    }

    /**
     *
     */
    public function actionStep4()
    {
        return $this->render('step4');
    }

    /**
     * Повторная отправка СМС
     */
    public function actionSendCode($id)
    {
        //Проверим есть ли неподтвержденный поставщик
        $model = RpManufacturer::find()
            ->andWhere([
                'id' => $id,
                'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED,
            ])
            ->one();
        if($model){

            //Создаем новое подтверждение
            $modelConfirmManufacturer = new ConfirmManufacturer();
            $modelConfirmManufacturer->manufacturer_id = $model->id;
            //$modelConfirmManufacturer->code = rand(1000, 9999);
            $modelConfirmManufacturer->code = 3333;
            if($modelConfirmManufacturer->save()){
                return $this->redirect(['step3', 'id' => $modelConfirmManufacturer->id]);
            }
        }
        else{
            return $this->goHome();
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
