<?php


class SectionTable extends Doctrine_Table
{
    public function doSelectForSlug($parameters) {
        return $this->findOneBySlugAndCulture($parameters['slug'], $parameters['sf_culture']);
    }

    public function findOneBySlugAndCulture($slug, $culture = 'en') {
        $q = $this->createQuery('a')
                ->leftJoin('a.Translation t')
                ->andWhere('t.lang = ?', $culture)
                ->andWhere('t.slug = ?', $slug);
        return $q->fetchOne();
    }

    public function findOneBySlug($slug) {
        return $this->findOneBySlugAndCulture($slug, 'de');
    }

    public function getOnlineSections()
    {
        return $this->createQuery()
                ->where('online = 1')
                ->orderBy('sort_order ASC')
                ->execute();
    }
}