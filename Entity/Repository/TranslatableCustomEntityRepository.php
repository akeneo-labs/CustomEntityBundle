<?php

namespace Pim\Bundle\CustomEntityBundle\Entity\Repository;

/**
 * Repository for translatable custom entities
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class TranslatableCustomEntityRepository extends CustomEntityRepository implements LocaleAwareRepositoryInterface,
    DatagridAwareRepositoryInterface
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * {@inheritdoc}
     */
    public function createDatagridQueryBuilder(array $config)
    {
        return $this->createQueryBuilder('o')
            ->leftJoin("o.translations", 'translation', 'WITH', 'translation.locale=:locale')
            ->setParameter('locale', $this->locale)
            ->select("o, translation");
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
