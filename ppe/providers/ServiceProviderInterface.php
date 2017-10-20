<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 10:51
 */

namespace Framework\Providers;

use Phalcon\Di\InjectionAwareInterface;

/**
 * \Apps\Providers\ServiceProviderInterface
 *
 * @package Apps\Providers
 */
interface ServiceProviderInterface extends InjectionAwareInterface
{
    /**
     * Register application service.
     *
     * @return mixed
     */
    public function register();

    /**
     * Gets the Service name.
     *
     * @return string
     */
    public function getName();
}