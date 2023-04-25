import { 
    useBlockProps, InspectorControls, RichText, MediaPlaceholder
  } from '@wordpress/block-editor';
  import { __ } from '@wordpress/i18n';
  import { 
    PanelBody, TextareaControl, Spinner
  } from '@wordpress/components';
  import { isBlobURL, revokeBlobURL } from '@wordpress/blob';
  import { useState } from '@wordpress/element';

export default function({ attributes, setAttributes }) {
    const { 
      name, title, bio, imgID, imgAlt, imgURL, socialHandles
    } = attributes;
    const blockProps = useBlockProps();

    const [imgPreview, setImgPreview] = useState(imgURL)

    return (
      <>
        <InspectorControls>
          <PanelBody title={__('Settings', 'udemy-plus')}>
            <TextareaControl 
              label={__('Alt Attribute', 'udemy-plus')}
              value={imgAlt}
              onChange={imgAlt => setAttributes({imgAlt})}
              help={__(
                'Description of your image for screen readers.',
                'udemy-plus'
              )}
            />
          </PanelBody>
        </InspectorControls>
        <div {...blockProps}>
          <div className="author-meta">
            {
                imgPreview && <img src={imgPreview} alt={imgAlt} /> 
            }
            {
                isBlobURL(imgPreview) &&  <Spinner />
            }
            <MediaPlaceholder 
                acceptedTypes={['image']}
                accept={'image/*'}
                icon="admin-users"
                onSelect={img => {
                  
                    let newImgURL = null

                    if(isBlobURL(img.url)){
                        newImgURL = img.url
                    } else {
                        newImgURL = img.sizes ? 
                            img.sizes.teamMember.url :
                            img.media_details.sizes.teamMember.source_url

                        setAttributes({
                            imgID: img.id,
                            imgAlt: img.alt,
                            imgURL: newImgURL
                        })

                        revokeBlobURL(imgPreview)
                    }
                    setImgPreview(newImgURL)
                }}
                onError={error => console.log(error)}
                disableMediaButtons={imgPreview}
                onSelectURL={url => {
                    setAttributes({
                        imgID: null,
                        imgAlt: null,
                        imgURL: url
                    })
                }}
            />
            <p>
              <RichText 
                placeholder={__('Name', 'udemy-plus')}
                tagName="strong"
                onChange={name => setAttributes({name})}
                value={name}
              />
              <RichText 
                placeholder={__('Title', 'udemy-plus')}
                tagName="span"
                onChange={title => setAttributes({title})}
                value={title}
              />
            </p>
          </div>
          <div className="member-bio">
            <RichText 
              placeholder={__('Member bio', 'udemy-plus')}
              tagName="p"
              onChange={bio => setAttributes({bio})}
              value={bio}
            />
          </div>
          <div className="social-links"></div>
        </div>
      </>
    );
  }