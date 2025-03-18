import { useBlockProps, RichText } from '@wordpress/block-editor';
import './editor.scss'; // импорт стилей для редактора
export default function Edit( { attributes, setAttributes } ) {
	const { text } = attributes;
	const blockProps = useBlockProps();
	// console.log(blockProps); // {id: 'block-6fdc1f4e-8c6e-4241-bf0b-36624c3a399e', tabIndex: 0, role: 'document', aria-label: 'Блок: My Block', ref: ƒ, …}
	// return <h1 { ...blockProps }>Edit 2</h1>;
	return <RichText allowedFormats={ [ 'core/bold' ] } { ...blockProps } value={ text } onChange={ ( value ) => setAttributes( { text: value } ) } tagName="h1" placeholder={ 'Введите заголовок' } />;
}
