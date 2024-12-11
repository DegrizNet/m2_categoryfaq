<?php
namespace Magelan\CategoryFaq\Plugin\Catalog\Model\Category;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Config;

class LoadFaqAttributes
{
    protected $eavConfig;

    public function __construct(Config $eavConfig)
    {
        $this->eavConfig = $eavConfig;
    }

    public function afterLoad(Category $subject, Category $result)
    {
        // Preload FAQ attributes and attach them to the category model
        for ($i = 1; $i <= 8; $i++) {
            $questionAttribute = $this->eavConfig->getAttribute(Category::ENTITY, "catalog_question{$i}");
            $answerAttribute = $this->eavConfig->getAttribute(Category::ENTITY, "catalog_answer{$i}");

            // You can attach the attributes to the result object if needed
            $result->setData("catalog_question{$i}", $questionAttribute ? $questionAttribute->getFrontend()->getValue($result) : '');
            $result->setData("catalog_answer{$i}", $answerAttribute ? $answerAttribute->getFrontend()->getValue($result) : '');
        }

        return $result;
    }
}
