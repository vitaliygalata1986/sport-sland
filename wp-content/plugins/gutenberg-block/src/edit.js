import {
	useBlockProps,
	RichText,
	BlockControls,
} from '@wordpress/block-editor';
import {
	ToolbarGroup,
	ToolbarButton,
	ToolbarDropdownMenu,
} from '@wordpress/components';
import './editor.scss'; // импорт стилей для редактора
export default function Edit({ attributes, setAttributes }) {
	const { text } = attributes;
	// console.log('text', text); // Text 1
	const blockProps = useBlockProps();
	// console.log(blockProps); // {id: 'block-6fdc1f4e-8c6e-4241-bf0b-36624c3a399e', tabIndex: 0, role: 'document', aria-label: 'Блок: My Block', ref: ƒ, …}
	// return <h1 { ...blockProps }>Edit 2</h1>;
	// return <RichText allowedFormats={ [ 'core/bold' ] } { ...blockProps } value={ text } onChange={ ( value ) => setAttributes( { text: value } ) } tagName="h1" placeholder={ 'Введите заголовок' } />;
	return (
		<>
			<BlockControls
				controls={[
					{
						title: 'Button',
						icon: 'admin-media',
						isActive: true,
						onClick: () => console.log('Button Clicked'),
					},
					{
						title: 'Button 2',
						icon: 'admin-customizer',
						onClick: () => console.log('Button 2 Clicked'),
					},
				]}
			>
				{text && (
					<ToolbarGroup>
						<p>Align: </p>
						<ToolbarButton
							title="Align Left"
							icon="editor-alignleft"
							onClick={() => console.log('Align Left')}
						/>
						<ToolbarButton
							title="Align Center"
							icon="editor-aligncenter"
							onClick={() => console.log('Align Center')}
						/>
						<ToolbarButton
							title="Align Right"
							icon="editor-alignright"
							onClick={() => console.log('Align Right')}
						/>
						<ToolbarDropdownMenu
							icon="arrow-down-alt2"
							label="More Option"
							controls={[
								{
									title: 'Button 1',
									icon: 'admin-media',
								},
								{
									title: 'Button 2',
									icon: 'admin-media',
								},
							]}
						/>
					</ToolbarGroup>
				)}
				<ToolbarGroup>
					<ToolbarButton title="Test button" icon="admin-comments" />
				</ToolbarGroup>
			</BlockControls>
			<RichText
				allowedFormats={[]}
				{...blockProps}
				value={text}
				onChange={(value) => setAttributes({ text: value })}
				tagName="h1"
				placeholder={'Введите заголовок'}
			/>
			;
		</>
	);
}
