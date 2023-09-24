<p class="gdpr-terms-container">
    <input id="gdpr_checkbox_top" type="checkbox" required name="gdpr_terms" id="gdpr_terms" value="1" />
    <label for="gdpr_checkbox_top">
        <?php if ($termsUrl): ?>
            <?php gutentype_show_layout(sprintf(
                esc_html__('I accept the %sTerms and Conditions%s and the %sPrivacy Policy%s', 'gutentype'),
                "<a href='{$termsUrl}' target='_blank'>",
                '</a>',
                "<a href='{$privacyPolicyUrl}' target='_blank'>",
                '</a>')
            ); ?>
        <?php else: ?>
            <?php gutentype_show_layout(sprintf(
					esc_html__('I accept the %sPrivacy Policy%s', 'gutentype'),
                "<a href='{$privacyPolicyUrl}' target='_blank'>",
                '</a>')
            ); ?>
        <?php endif; ?>*
    </label>
</p>
