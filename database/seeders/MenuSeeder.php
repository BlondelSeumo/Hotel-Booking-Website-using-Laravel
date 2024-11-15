<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Post;
use Botble\Hotel\Models\Place;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\Service;
use Botble\Language\Models\LanguageMeta;
use Botble\Menu\Facades\Menu;
use Botble\Menu\Models\Menu as MenuModel;
use Botble\Menu\Models\MenuLocation;
use Botble\Menu\Models\MenuNode;
use Botble\Page\Models\Page;
use Botble\Team\Models\Team;
use Illuminate\Support\Arr;

class MenuSeeder extends BaseSeeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Main menu',
                'slug' => 'main-menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Home Page 01'),
                        'children' => [
                            [
                                'title' => 'Home Page 01',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Home Page 01'),
                            ],
                            [
                                'title' => 'Home Page 02',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Home Page 02'),
                            ],
                            [
                                'title' => 'Home Page Side Menu',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Home Page Side Menu'),
                            ],
                            [
                                'title' => 'Home Page Full Menu',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Home Page Full Menu'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Our Rooms',
                        'url' => '/rooms',
                        'children' => [
                            [
                                'title' => 'Our Rooms',
                                'url' => '/rooms',
                            ],
                            [
                                'title' => 'Room Details',
                                'url' => Room::query()->inRandomOrder()->first()->url,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Pages',
                        'url' => '',
                        'children' => [
                            [
                                'title' => 'Gallery',
                                'url' => '/galleries',
                            ],
                            [
                                'title' => 'FAQ',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('FAQ'),
                            ],
                            [
                                'title' => 'Team',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Team'),
                            ],
                            [
                                'title' => 'Team Details',
                                'url' => Team::query()->inRandomOrder()->first()->url,
                            ],
                            [
                                'title' => 'Services',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Services'),
                            ],
                            [
                                'title' => 'Service Details',
                                'url' => Service::query()->inRandomOrder()->first()->url,
                            ],
                            [
                                'title' => 'Places',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Places'),
                            ],
                            [
                                'title' => 'Place Details',
                                'url' => Place::query()->inRandomOrder()->first()->url,
                            ],
                            [
                                'title' => 'About Us',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('About Us'),
                            ],
                            [
                                'title' => 'Contact Us',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Contact Us'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Blog',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Blog'),
                        'children' => [
                            [
                                'title' => 'Blog',
                                'reference_type' => Page::class,
                                'reference_id' => $this->getPageId('Blog'),
                            ],
                            [
                                'title' => 'Blog Details',
                                'url' => Post::query()->inRandomOrder()->first()->url,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Our Links',
                'slug' => 'our-links',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/',
                    ],
                    [
                        'title' => 'About Us',
                        'url' => '/about-us',
                    ],
                    [
                        'title' => 'Services',
                        'url' => '/services',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Services'),
                    ],
                    [
                        'title' => 'Contact Us',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Contact Us'),
                    ],
                    [
                        'title' => 'Blog',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Blog'),
                    ],
                ],
            ],
            [
                'name' => 'Our Services',
                'slug' => 'our-services',
                'items' => [
                    [
                        'title' => 'FAQ',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('FAQ'),
                    ],
                    [
                        'title' => 'Support',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Support'),
                    ],
                    [
                        'title' => 'Privacy',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Privacy'),
                    ],
                    [
                        'title' => 'Term & Conditions',
                        'reference_type' => Page::class,
                        'reference_id' => $this->getPageId('Term and Conditions'),
                    ],
                ],
            ],
            [
                'name' => 'Sidebar Menu',
                'slug' => 'sidebar-menu',
                'location' => 'sidebar-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/home',
                    ],
                    [
                        'title' => 'About Us',
                        'url' => '/about-us',
                    ],
                    [
                        'title' => 'Services',
                        'url' => '/services',
                    ],
                    [
                        'title' => 'Pricing',
                        'url' => '/pricing',
                    ],
                    [
                        'title' => 'Team',
                        'url' => '/team',
                    ],
                    [
                        'title' => 'Gallery Study',
                        'url' => '/gallery',
                    ],
                    [
                        'title' => 'Blog',
                        'url' => '/blog',
                    ],
                    [
                        'title' => 'Contact',
                        'url' => '/contact-us',
                    ],
                ],
            ],
        ];

        MenuModel::query()->truncate();
        MenuLocation::query()->truncate();
        MenuNode::query()->truncate();

        foreach ($data as $index => $item) {
            $item['items'] = $this->mapMenuNodes($item['items']);
            $menu = MenuModel::query()->create(Arr::except($item, ['items', 'location']));

            if (isset($item['location'])) {
                $menuLocation = MenuLocation::query()->create([
                    'menu_id' => $menu->id,
                    'location' => $item['location'],
                ]);

                LanguageMeta::saveMetaData($menuLocation);
            }

            foreach ($item['items'] as $menuNode) {
                $this->createMenuNode($index, $menuNode, 'en_US', $menu->id);
            }

            LanguageMeta::saveMetaData($menu);
        }

        Menu::clearCacheMenuItems();
    }

    protected function createMenuNode(
        int $index,
        array $menuNode,
        string $locale,
        int|string $menuId,
        int|string $parentId = 0
    ): void {
        $menuNode['menu_id'] = $menuId;
        $menuNode['parent_id'] = $parentId;

        if (isset($menuNode['url'])) {
            $menuNode['url'] = str_replace(url(''), '', $menuNode['url']);
        }

        if (Arr::has($menuNode, 'children')) {
            $children = $menuNode['children'];
            $menuNode['has_child'] = true;

            unset($menuNode['children']);
        } else {
            $children = [];
            $menuNode['has_child'] = false;
        }

        $createdNode = MenuNode::query()->create($menuNode);

        if ($children) {
            foreach ($children as $child) {
                $this->createMenuNode($index, $child, $locale, $menuId, $createdNode->id);
            }
        }
    }

    protected function getPageId(string $name): int
    {
        return (int) Page::query()->where('name', $name)->value('id');
    }

    protected function mapMenuNodes($items): array
    {
        if (empty($items)) {
            return $items;
        }

        foreach ($items as $position => $node) {
            $items[$position] = array_merge($node, [
                'position' => $position,
            ]);

            if (! empty($node['children'])) {
                $items[$position]['children'] = $this->mapMenuNodes($node['children']);
            }
        }

        return $items;
    }
}
