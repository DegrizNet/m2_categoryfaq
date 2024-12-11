<?php
namespace Magelan\CategoryFaq\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Category;
use Magento\Framework\Registry;

class CategoryFaq extends Template
{
    protected $category;
    protected $_coreRegistry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getCurrentCategory()
    {
        return $this->_coreRegistry->registry('current_category');
    }

    public function getFaqItems()
    {
        $category = $this->getCurrentCategory();
        $faqItems = [];

        for ($i = 1; $i <= 8; $i++) {
            $question = $category->getData("catalog_question{$i}");
            $answer = $category->getData("catalog_answer{$i}");

            if ($question && $answer) {
                $faqItems[] = [
                    'question' => $question,
                    'answer' => $answer
                ];
            }
        }

        return $faqItems;
    }

    public function hasFaqItems()
    {
        return !empty($this->getFaqItems());
    }
}