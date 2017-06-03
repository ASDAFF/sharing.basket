<?
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 01.06.2017
 * Time: 18:59
 *
 * @author    Alexey Panov <panov@codeblog.pro>
 * @copyright Copyright © 2016, Alexey Panov
 */
namespace CodeBlog\SharingBasket\Sending;


use \Bitrix\Main\Mail\Event;

/**
 * Class Email
 *
 * @package CodeBlog\SharingBasket\Sending
 */
class Email implements Sending
{
    const LIMIT_SENDING = 5;

    public static function send($recipient, $basket) {

        if ($basket->getNotifyQuantityToEmail() >= self::LIMIT_SENDING) {

            /**
             * @ToDo: Вынести $request  в отдельный класс,
             * чтобы унифицировать вывод сообщений о результате
             * и ошибок в модуле
             */
            return($request = [
                'STATUS' => false,
                'MESSAGE' => 'Limits error'
            ]);
        }

        /**
         * @ToDo Добавить добавление соответствующего типа шаблонов
         * и шаблона письма при установке модуля
         */
        $resultSend = Event::send([
            'EVENT_NAME' => 'CODEBLOGPRO_CODE_SEND',
            'LID' => SITE_ID,
            'C_FIELDS' => [
                'EMAIL' => $recipient,
                'BASKET_CODE' => $basket->getCode()
            ],
        ]);

        /**
         * @Todo проверить, отправляется ли Email
         * на самом деле
         */
        \CEvent::CheckEvents();

        return($request = [
            'STATUS' => $resultSend->isSuccess(),
            'MESSAGE' => ($resultSend->isSuccess()) ? '' : 'Other error'
        ]);
    }
}