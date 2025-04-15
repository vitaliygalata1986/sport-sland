import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import './style.scss'; // импорт стилей для фронтенда и редактора

registerBlockType('vitos/dynamicblock', {
	edit: Edit,
	save: Save,
});
