import {
	useBlockProps,
	RichText,
	BlockControls,
	AlignmentToolbar,
} from '@wordpress/block-editor';
import './editor.scss'; // импорт стилей для редактора
export default function Edit({ attributes, setAttributes }) {
	const { text, align } = attributes;
	return (
		<>
			<BlockControls>
				<AlignmentToolbar
					value={align}
					onChange={(value) => setAttributes({ align: value })}
				/>
			</BlockControls>
			<RichText
				{...useBlockProps({
					className: `vitos-align-${align}`,
				})}
				tagName="h1"
				value={text}
				onChange={(value) => setAttributes({ text: value })}
				placeholder={'Введите заголовок'}
				allowedFormats={[]}
			/>
		</>
	);
}
