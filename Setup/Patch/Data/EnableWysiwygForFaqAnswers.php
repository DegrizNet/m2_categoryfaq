<?php
namespace Magelan\CategoryFaq\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class EnableWysiwygForFaqAnswers implements DataPatchInterface
{
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly EavSetupFactory $eavSetupFactory
    ) {}

    public function apply(): self
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        for ($i = 1; $i <= 8; $i++) {
            $eavSetup->updateAttribute(
                Category::ENTITY,
                "catalog_answer{$i}",
                'is_wysiwyg_enabled',
                1
            );
        }
        return $this;
    }

    public function getAliases(): array
    {
        return [];
    }

    public static function getDependencies(): array
    {
        return [];
    }
}
