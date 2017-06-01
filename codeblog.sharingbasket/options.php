<?
/**
 * Created by PhpStorm.
 * Date: 10.01.2017
 * Time: 11:00
 *
 * @package   CodeBlog
 * @category  Bitrix, basket module
 * @author    Alexey Panov <panov@codeblog.pro>
 * @copyright Copyright ? 2016, Alexey Panov
 */
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use CodeBlog\SharingBasket\Vendor;
use Bitrix\Main\Loader;

Loader::includeModule('codeblog.sharingbasket');

$moduleId = 'codeblog.sharingbasket';
$mid       = $_REQUEST['mid'];
IncludeModuleLangFile(__FILE__);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $moduleId . '/include.php');
IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $moduleId . '/options.php');

$tabsList = [
    [
        'DIV' => 'edit1',
        'TAB' => '���������',
        'ICON' => '',
        'TITLE' => '���������'
    ]
];

$groupsList = [
    'MAIN' => ['TITLE' => '�������� ���������', 'TAB' => 0],
];

$optionsList = array(
    'TYPE_STORAGE' => [
        'GROUP' => 'MAIN',
        'TITLE' => '��� ���������',
        'TYPE' => 'STRING',
        'DEFAULT' => Option::get('codeblog.sharingbasket', 'typeStorage'),
        'SORT' => '0',
        'NOTES' => '����� �������� ����������� ������. �������� ��� ��������� ������.',
        'OTHER_PARAMETERS' => 'disabled',
    ],
    'IS_USE_SENDING_EMAIL' => [
        'GROUP' => 'MAIN',
        'TITLE' => '�������� ������ ������� �� Email',
        'TYPE' => 'CHECKBOX',
        'REFRESH' => 'Y',
        'SORT' => '10',
        'NOTES' => '��������� ���������� ����� ����������� ������� �� Email.',
    ],
    'IS_USE_SENDING_PHONE' => [
        'GROUP' => 'MAIN',
        'TITLE' => '�������� ������ ������� �� �������',
        'TYPE' => 'CHECKBOX',
        'REFRESH' => 'N',
        'SORT' => '20',
        'OTHER_PARAMETERS' => 'disabled="disabled"',
        'NOTES' => '��������� ���������� ����� ����������� ������� �� ��������� �������.',
    ],
    'LOG_IS_USE' => [
        'GROUP' => 'MAIN',
        'TITLE' => '������������ �����������',
        'TYPE' => 'CHECKBOX',
        'REFRESH' => (Option::get('codeblog.sharingbasket', 'LOG_IS_USE')) ? Option::get('codeblog.sharingbasket', 'LOG_IS_USE') : 'Y',
        'SORT' => '100',
        'NOTES' => '��������� ��������� � ����������� ������� ��������� ��� ������������ ������� ��� ��������� ������.',
    ],
    'LOG_FILE_NAME' => [
        'GROUP' => 'MAIN',
        'TITLE' => '��� ��� �����',
        'TYPE' => 'STRING',
        'DEFAULT' => empty(Option::get('codeblog.sharingbasket', 'LOG_FILE_NAME')) ? 'log.txt' : Option::get('codeblog.sharingbasket', 'LOG_FILE_NAME'),
        'SORT' => '110',
        'NOTES' => '��� ��� �����.',
    ],
);

$options = new Vendor\CModuleOptions($moduleId, $tabsList, $groupsList, $optionsList);
$options->ShowHTML();