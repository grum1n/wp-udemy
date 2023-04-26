import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';

registerPlugin("up-sidebar", {
    render() {
        return( 
            <PluginSidebar
                name="up_sidebar"
                icon="share"
                title={__("Udemy Plus Sidebar", "udemy-plus")}
            >
                Random Text

            </PluginSidebar>
        )

    }
})