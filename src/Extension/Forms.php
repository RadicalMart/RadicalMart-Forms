<?php
/*
 * @package     RadicalMart Package
 * @subpackage  plg_system_radicalmart
 * @version     __DEPLOY_VERSION__
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2025 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

namespace Joomla\Plugin\RadicalMart\Forms\Extension;

\defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\SubscriberInterface;
use Joomla\Filesystem\Path;

class Forms extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;
	use DatabaseAwareTrait;

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    bool
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $autoloadLanguage = true;

	/**
	 * Plugins forms path.
	 *
	 * @var    string
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected string $formsPath = JPATH_PLUGINS . '/radicalmart/forms/forms';

	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onRadicalMartPrepareForm'  => 'onRadicalMartPrepareForm',
			'onRadicalMartGetOrderForm' => 'onRadicalMartGetOrderForm',
		];
	}

	/**
	 * Listener for the `onRadicalMartPrepareForm` event.
	 *
	 * @param   Form   $form  The form to be altered.
	 * @param   mixed  $data  The associated data for the form.
	 *
	 * @throws \Exception
	 *
	 * @since __DEPLOY_VERSION__
	 */
	public function onRadicalMartPrepareForm(Form $form, mixed $data = []): void
	{
		$this->loadFormFile($form);
	}

	/**
	 * Listener for the `onRadicalMartGetOrderForm` event.
	 *
	 * @param   string            $context   Context selector string.
	 * @param   Form              $form      Order form object.
	 * @param   array             $formData  Form data array.
	 * @param   bool|array|null   $products  Shipping method data.
	 * @param   object|bool|null  $shipping  Shipping method data.
	 * @param   object|bool|null  $payment   Payment method data.
	 * @param   array             $currency  Order currency data.
	 *
	 * @throws \Exception
	 *
	 * @since __DEPLOY_VERSION__
	 */
	public function onRadicalMartGetOrderForm(string           $context, Form $form, array $formData,
	                                          bool|array|null  $products,
	                                          object|bool|null $shipping, object|bool|null $payment, array $currency): void
	{
		$this->loadFormFile($form);
	}

	/**
	 * Method to check form file and load if existed.
	 *
	 * @param   Form  $form  jForm object.
	 *
	 * @since __DEPLOY_VERSION__
	 */
	protected function loadFormFile(Form $form): void
	{
		$formName = $form->getName();
		if ($formName === 'com_config.component'
			&& $this->getApplication()->input->get('component') === 'com_radicalmart')
		{
			$formName = 'com_radicalmart.config';
		}
		$file = Path::clean($this->formsPath . '/' . $formName . '.xml');

		// DISPLAY FORM FILE PATH
		//echo '<pre>', print_r($file, true), '</pre>';

		if (!is_file($file))
		{
			return;
		}

		$form->loadFile($file);
	}
}