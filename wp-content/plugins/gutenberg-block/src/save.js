import { useBlockProps, RichText } from '@wordpress/block-editor'; // { useBlockProps } from '@wordpress/block-editor'; // react hook в котором хранятся свойства блока (классы, id, data-атрибуты и т.д.)

export default function save({ attributes }) {
	const { text, align, color, backgroundColor } = attributes;
	// const blockProps = useBlockProps.save(); // на фронте дефолтных свойств не будет
	// return <h1 { ...blockProps }>Save 2</h1>;
	return (
		<RichText.Content
			{...useBlockProps.save({
				className: `vitos-align-${align}`,
				style: { color, backgroundColor },
			})}
			tagName="h1"
			value={text}
		/>
	);
}
