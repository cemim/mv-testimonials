<?php 
    $occupation = get_post_meta($post->ID, 'mv_testimonials_occupation', true);
    $company = get_post_meta($post->ID, 'mv_testimonials_company', true);
    $user_url = get_post_meta($post->ID, 'mv_testimonials_user_url', true);
?>

<table class="form-table mv-testimonials-metabox"> 
    <input type="hidden" name="mv_testimonials_nonce" value="<?= wp_create_nonce('mv_testimonials_nonce') ?>">
    <tr>
        <th>
            <label for="mv_testimonials_occupation"><?php esc_html_e( 'User occupation', 'mv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="mv_testimonials_occupation" 
                id="mv_testimonials_occupation" 
                class="regular-text occupation"
                value="<?= esc_html($occupation) ?? '' ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mv_testimonials_company"><?php esc_html_e( 'User company', 'mv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="mv_testimonials_company" 
                id="mv_testimonials_company" 
                class="regular-text company"
                value="<?= esc_html($company) ?? '' ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="mv_testimonials_user_url"><?php esc_html_e( 'User URL', 'mv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="mv_testimonials_user_url" 
                id="mv_testimonials_user_url" 
                class="regular-text user-url"
                value="<?= esc_url($user_url) ?? '' ?>"
            >
        </td>
    </tr> 
</table>