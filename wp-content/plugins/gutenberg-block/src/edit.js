import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss'; // импорт стилей для редактора
export default function Edit() {
	const blockProps = useBlockProps();
	// console.log(blockProps); // {id: 'block-6fdc1f4e-8c6e-4241-bf0b-36624c3a399e', tabIndex: 0, role: 'document', aria-label: 'Блок: My Block', ref: ƒ, …}
	return <h1 { ...blockProps }>Edit 2</h1>;
}
