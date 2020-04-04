<h4 class="title title--density-cozy title--level-4 typography typography--weight-light with-color with-color--color-darkest sg-margin-top-large">
    <?php esc_html_e('WordPress Events and News', 'siteground-wizard') ?>
</h4>
<div id="dashboard_primary" class="events--news with-padding with-padding--padding-bottom-large">
    <div class="container container--padding-none container--elevation-1">
        <div class="wordpress--events with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-large">

        <?php
        wp_print_community_events_markup();
        wp_print_community_events_templates();
        ?>
        </div>

        <div class="wordpress--news hide-if-no-js with-padding with-padding--padding-top-x-small with-padding--padding-left-large with-padding--padding-right-large with-padding--padding-bottom-medium">
            <h6 class="title title--density-cozy title--level-6 typography typography--weight-bold with-color with-color--color-dark"><?php echo esc_html_e( 'Latest News', 'siteground-wizard' ) ?></h6>
            <div class="inside">
                <?php wp_dashboard_primary(); ?>
            </div>
        </div>

        <div class="community-events-footer toolbar toolbar--background-light toolbar--density-cozy flex--justify-flex-end">
            <?php
            printf(
                '<a href="%1$s" target="_blank" class="sg--button button--neutral button--medium"><span class="button__content"><span class="button__text">%2$s</span></span> <span class="screen-reader-text">%3$s</span></a>',
                'https://make.wordpress.org/community/meetups-landing-page',
                __('Meetups'),
                /* translators: accessibility text */
                __('(opens in a new window)')
            );
            ?>

            <?php
            printf(
                '<a href="%1$s" target="_blank" class="sg--button button--neutral button--medium"><span class="button__content"><span class="button__text">%2$s</span></span> <span class="screen-reader-text">%3$s</span></a>',
                'https://central.wordcamp.org/schedule/',
                __('WordCamps'),
                /* translators: accessibility text */
                __('(opens in a new window)')
            );
            ?>

            <?php
            printf(
                '<a href="%1$s" target="_blank" class="sg--button button--neutral button--medium"><span class="button__content"><span class="button__text">%2$s</span></span> <span class="screen-reader-text">%3$s</span></a>',
                /* translators: If a Rosetta site exists (e.g. https://es.wordpress.org/news/), then use that. Otherwise, leave untranslated. */
                esc_url(_x('https://wordpress.org/news/', 'Events and News dashboard widget')),
                __('News'),
                /* translators: accessibility text */
                __('(opens in a new window)')
            );
            ?>
        </div>
    </div>
</div>