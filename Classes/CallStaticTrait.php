<?php

namespace DWenzel\Reporter;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Dirk Wenzel
 *  All rights reserved
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * A copy is found in the text file GPL.txt and important notices to the license
 * from the author is found in LICENSE.txt distributed with these scripts.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Trait for static method calls
 *
 * This is useful to make static method calls mock-able in tests.
 *
 * This trait must not be used more than once in a class hierarchy,
 * otherwise endless call loops occur for parent method calls.
 * See https://bugs.php.net/bug.php?id=48770 for details.
 */
trait CallStaticTrait
{
    /**
     * Performs a static method call
     *
     * Note that parent::class should be used instead of 'parent'
     * to refer to the actual parent class.
     *
     * @param string $className Name of the class
     * @param string $methodName Name of the method
     * @return mixed
     */
    protected function callStatic($className, $methodName)
    {
        $parameters = func_get_args();
        $parameters = array_slice($parameters, 2); // Remove $className and $methodName

        return call_user_func_array($className . '::' . $methodName, $parameters);
    }
}
