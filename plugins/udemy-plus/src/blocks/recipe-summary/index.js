import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
//if you need to grab data to posts, you will most likely import a function from package, we are importing function useEntityProp
//useEntityProp function will return and entity form metadata
//an entity is an object that reprecents data
// WP will create objects for interacting with this data
// WP has a similar feature called State
// React has useState(), WP has a similar  feature for managing its own data called entities
import { useEntityProp } from '@wordpress/core-data'; //ok
//has functions for interacting  with data in general
//These functions can create custom data or grab data from a difference database
import { useSelect } from '@wordpress/data';
import { Spinner } from '@wordpress/components';
import icons from '../../icons.js';
import './main.css';

registerBlockType('udemy-plus/recipe-summary', {
  icon: {
    src: icons.primary
  },
  edit({ attributes, setAttributes, context }) {
    const { prepTime, cookTime, course } = attributes;
    const blockProps = useBlockProps();
    const { postId } = context;
    //console.log(postId) id is here

    //this function will return an array
    //lets grab the first item by adding a name 
    // must add 4 arguments to filter the values
    const [termIDs] = useEntityProp(
        'postType', 'recipe', 'cuisine', postId
    );

    const { cuisines, isLoading } = useSelect((select) => {
        const { getEntityRecords, isResolving } = select('core');

        const taxonomyArgs = [
            'taxonomy', 
            'cuisine', 
            {
                include: termIDs
            }
        ]

        return {
            cuisines: getEntityRecords(...taxonomyArgs),
            isLoading: isResolving('getEntityRecords', taxonomyArgs) 
        }
    }, [termIDs])

    const { rating } = useSelect(select => {
        const { getCurrentPostAttribute } = select('core/editor')

        return {
            rating: getCurrentPostAttribute('meta').recipe_rating
        }
    })



    console.log(rating)
    //termIDs data is here
    //just open Guttenberg editor and in right sidebar To cuisine add new tag

    return (
      <>
        <div {...blockProps}>
          <i className="bi bi-alarm"></i>
          <div className="recipe-columns-2">
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Prep Time', 'udemy-plus')}</div>
              <div className="recipe-data recipe-prep-time">
                <RichText
                  tagName="span"
                  value={ prepTime } 
                  onChange={ prepTime => setAttributes({ prepTime }) }
                  placeholder={ __('Prep time', 'udemy-plus') }
                />
              </div>
            </div>
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Cook Time', 'udemy-plus')}</div>
              <div className="recipe-data recipe-cook-time">
                <RichText
                  tagName="span"
                  value={ cookTime } 
                  onChange={ cookTime => setAttributes({ cookTime }) }
                  placeholder={ __('Cook time', 'udemy-plus') }
                />
              </div>
            </div>
          </div>
          <div className="recipe-columns-2-alt">
            <div className="recipe-columns-2">
              <div className="recipe-metadata">
                <div className="recipe-title">{__('Course', 'udemy-plus')}</div>
                <div className="recipe-data recipe-course">
                  <RichText
                    tagName="span"
                    value={ course } 
                    onChange={ course => setAttributes({ course }) }
                    placeholder={ __('Course', 'udemy-plus') }
                  />
                </div>
              </div>
              <div className="recipe-metadata">
                <div className="recipe-title">{__('Cuisine', 'udemy-plus')}</div>
                <div className="recipe-data recipe-cuisine">
                    {
                        isLoading &&
                        <Spinner />
                    }
                    {
                        !isLoading && cuisines && cuisines.map((item, index) => {
                            const comma = cuisines[index + 1] ? ',' : ''
                            return(
                                <>
                                    <a href={item.meta.more_info_url}>
                                        {item.name}
                                    </a> {comma}
                                </>
                            )
                        })
                    }
                </div>
              </div>
              <i className="bi bi-egg-fried"></i>
            </div>
            <div className="recipe-metadata">
              <div className="recipe-title">{__('Rating', 'udemy-plus')}</div>
              <div className="recipe-data">
              </div>
              <i className="bi bi-hand-thumbs-up"></i>
            </div>
          </div>
        </div>
      </>
    );
  }
});