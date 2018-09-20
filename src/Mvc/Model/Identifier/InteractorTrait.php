<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Mvc\Model\Identifier;


use Galactium\Space\Identifier\Manager;
use Phalcon\Mvc\ModelInterface;
use function Galactium\Space\Helpers\container;

trait InteractorTrait
{
    /**
     * @return null|ModelInterface
     */
    public function interacte(): ?ModelInterface
    {
        /**
         * @var Manager $identifierManager
         */
        $identifierManager = container('identifierManager');
        $identifier = $identifierManager->parse($this->getGuid());

        $model = $identifier->getIdentifiable();

        $result = $model::findFirst($identifier->getParams()[1]);
        if ($result === false) {
            return null;
        }
        return $result;
    }
}