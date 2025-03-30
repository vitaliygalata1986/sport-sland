import {
	useBlockProps,
	InnerBlocks,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { columns } = attributes;
	return (
		<div
			{...useBlockProps({
				className: `the-${columns}-columns`,
			})}
		>
			<InspectorControls>
				<PanelBody>
					<RangeControl
						label={__('Columns', 'myblocks')}
						min={1}
						max={4}
						value={columns}
						onChange={(val) => setAttributes({ columns: val })}
					/>
				</PanelBody>
			</InspectorControls>
			<InnerBlocks
			/*
        template={[
          [
            'vitos/myblock',
            {
              title: 'Smth title',
              description: 'Smth description',
            },
          ],
          [
            'vitos/myblock',
            {
              title: 'Smth title 2',
              description: 'Smth description 2',
            },
          ],
        ]}
        allowedBlocks={['vitos/myblock']}
		*/
			/>
		</div>
	);
}

// allowedBlocks={['core/image']} - разрешаем добавлять только картинки
