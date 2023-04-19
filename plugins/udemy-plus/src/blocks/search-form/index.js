import { registerBlockType } from '@wordpress/blocks';
import block from './block.json';
import icons from '../../icons.js';

registerBlockType(block.name, {
    icon: icons.primary,
    edit(){
       return <p>search form</p> 
    }
});