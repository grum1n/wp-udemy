import { registerBlockType } from '@wordpress/blocks'
import { 
  useBlockProps, InspectorControls, RichText
} from '@wordpress/block-editor'
import { __ } from '@wordpress/i18n'
import { PanelBody } from '@wordpress/components'
import icons from '../../icons.js'
import './main.css'

registerBlockType('udemy-plus/popular-recipes', {
  icon: {
    src: icons.primary
  },
	edit({ attributes, setAttributes }) {
    const { title, count, cuisines } = attributes
    const blockProps = useBlockProps()

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Settings', 'udemy-plus')}>
            
          </PanelBody>
        </InspectorControls>
        <div {...blockProps}>
          <RichText
            tagName="h6"
            value={ title }
            withoutInteractiveFormatting
            onChange={ title => setAttributes({ title }) }
            placeholder={ __('Title', 'udemy-plus') }
          />
          <div class="single-post">
            <a class="single-post-image" href="#">
              <img src="" alt="" />
            </a>
            <div class="single-post-detail">
              <a href="#">Example Title</a>
              <span>
                by <a href="#">John Doe</a>
              </span>
            </div>
          </div>
        </div>
      </>
    );
  }
});