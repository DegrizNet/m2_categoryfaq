<?php
namespace Magelan\CategoryFaq\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Setup\CategorySetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
    private $categorySetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);

        // Add FAQ attribute group
        $categorySetup->addAttributeGroup(
            Category::ENTITY,
            $categorySetup->getDefaultAttributeSetId(Category::ENTITY),
            'FAQ',
            200 // Sort order
        );

        // Add FAQ attributes (Questions and Answers)
        for ($i = 1; $i <= 8; $i++) {
            // Question Attribute
            $questionAttributeId = $eavSetup->addAttribute(
                Category::ENTITY,
                "catalog_question{$i}",
                [
                    'type' => 'varchar',
                    'label' => "Question {$i}",
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 100 + $i,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'FAQ',
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true
                ]
            );

            // Answer Attribute
            $answerAttributeId = $eavSetup->addAttribute(
                Category::ENTITY,
                "catalog_answer{$i}",
                [
                    'type' => 'text',
                    'label' => "Answer {$i}",
                    'input' => 'textarea',
                    'required' => false,
                    'sort_order' => 200 + $i,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'FAQ',
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true
                ]
            );

            // Add attributes to the FAQ group
            $attributeSetId = $categorySetup->getDefaultAttributeSetId(Category::ENTITY);
            $attributeGroupId = $categorySetup->getAttributeGroupId(
                Category::ENTITY, 
                $attributeSetId, 
                'FAQ'
            );

            $categorySetup->addAttributeToGroup(
                Category::ENTITY,
                $attributeSetId,
                $attributeGroupId,
                $questionAttributeId,
                100 + $i
            );

            $categorySetup->addAttributeToGroup(
                Category::ENTITY,
                $attributeSetId,
                $attributeGroupId,
                $answerAttributeId,
                200 + $i
            );
        }
    }
}