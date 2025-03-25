import {
	useBlockProps,
	RichText,
	BlockControls,
	AlignmentToolbar,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	ToggleControl,
	TextControl,
	TextareaControl,
	ColorPicker,
	ColorPalette,
} from '@wordpress/components';
import './editor.scss'; // импорт стилей для редактора
export default function Edit({ attributes, setAttributes }) {
	const { text, align, color, backgroundColor } = attributes;
	const onChangeText = (val) => {
		setAttributes({ text: val });
	};

	const onChangeColor = (newColor) => {
		setAttributes({ color: newColor });
	};

	const onChangeBackgroundColor = (newBgColor) => {
		setAttributes({ backgroundColor: newBgColor });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="Content" initialOpen>
					<TextControl
						label="Title"
						value={text}
						help="Inseret Title TextControl"
						onChange={onChangeText}
					/>
					<TextareaControl
						label="Title"
						value={text}
						help="Inseret Title"
						onChange={onChangeText}
					/>
					<ColorPicker
						label="Text Color"
						color={color}
						onChange={onChangeColor}
						value={text}
						enableAlpha
					/>
					<ColorPalette
						label="Background Color"
						colors={[
							{ name: 'gray', color: '#f5f5f5' },
							{ name: 'black', color: '#000' },
						]}
						value={backgroundColor}
						onChange={onChangeBackgroundColor}
					/>
					<ToggleControl label="Yes or No" checked={true} />
				</PanelBody>
			</InspectorControls>
			<BlockControls>
				<AlignmentToolbar
					value={align}
					onChange={(value) => setAttributes({ align: value })}
				/>
			</BlockControls>
			<RichText
				{...useBlockProps({
					className: `vitos-align-${align}`,
					style: { color, backgroundColor },
				})}
				tagName="h1"
				value={text}
				onChange={onChangeText}
				placeholder={'Введите заголовок'}
				allowedFormats={[]}
			/>
		</>
	);
}
