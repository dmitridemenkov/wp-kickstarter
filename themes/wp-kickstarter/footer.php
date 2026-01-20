<footer class="bg-[#333] py-16 md:py-20 text-white">
    <div class="container mx-auto px-4">
        <!-- Main Footer Links -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16 mb-16">
            <!-- Column 1 -->
            <div>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_col_1',
                    'container' => false,
                    'menu_class' => 'flex flex-col items-center lg:items-start gap-4 font-["Montserrat",sans-serif] font-medium text-base text-white text-center lg:text-left',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- Column 2 -->
            <div>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_col_2',
                    'container' => false,
                    'menu_class' => 'flex flex-col items-center lg:items-start gap-4 font-["Montserrat",sans-serif] font-medium text-base text-white text-center lg:text-left',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- Column 3 -->
            <div>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_col_3',
                    'container' => false,
                    'menu_class' => 'flex flex-col items-center lg:items-start gap-4 font-["Montserrat",sans-serif] font-medium text-base text-white text-center lg:text-left',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- Column 4: Contacts -->
            <div class="flex flex-col items-center lg:items-start gap-6 font-['Montserrat',sans-serif] font-medium text-base text-white/80 text-center lg:text-left">
                <?php 
                $address = get_option('lavanda_address', '');
                if ($address): ?>
                    <p class="leading-relaxed"><?php echo esc_html($address); ?></p>
                <?php endif; ?>

                <?php 
                $phones = get_option('lavanda_phones', []);
                if (!empty($phones) && is_array($phones)): 
                    foreach ($phones as $phone): ?>
                        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>" class="hover:text-white transition-colors">
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endforeach;
                endif; ?>

                <!-- Socials/Links -->
                <?php 
                $socials = get_option('lavanda_socials', []);
                if (!empty($socials) && is_array($socials)): ?>
                    <div class="flex flex-col items-center lg:items-start gap-4 mt-2">
                        <?php foreach ($socials as $social): ?>
                            <?php if (is_array($social) && !empty($social['url'])): ?>
                                <a href="<?php echo esc_url($social['url']); ?>" class="flex items-center gap-2 hover:text-white transition-colors">
                                    <?php if (!empty($social['icon'])): ?>
                                        <img src="<?php echo esc_url($social['icon']); ?>" alt="" class="w-6 h-6 object-contain">
                                    <?php endif; ?>
                                    <span><?php echo esc_html($social['label'] ?? ''); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-white/10 pt-12 text-center flex flex-col items-center gap-6">
            <p class="font-['Montserrat',sans-serif] font-medium text-sm text-white/60">
                ИП Чудиновских Никита Александрович<br />
                ИНН 434585804109
            </p>
            <p class="font-['Montserrat',sans-serif] font-medium text-sm text-white/60 uppercase tracking-widest">
                Все права защищены &copy; <?php echo date('Y'); ?>
            </p>
            <p class="font-['Montserrat',sans-serif] font-medium text-sm text-white/60">
                Отправляя любую форму на сайте, вы соглашаетесь с 
                <a href="/confidentiality.pdf" class="underline hover:text-white transition-colors">
                    политикой конфиденциальности
                </a>
                данного сайта
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>



</body>
</html>