import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { format, dateI18n, getSettings } from '@wordpress/date';
import { PanelBody, ToggleControl, QueryControls } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import './editor.scss'; // импорт стилей для редактора

export default function Edit({ attributes, setAttributes }) {
	const { postsPerPage, showImage, order, orderBy, category } = attributes; // получим кол. постов из атрибутов
	// получим посты
	const posts = useSelect((select) => {
		return select('core').getEntityRecords(
			'postType',
			'post',
			{
				per_page: postsPerPage,
				_embed: true,
				order,
				orderby: orderBy,
				categories: category ? category : [], // если нет категории, то пустой массив (при выборе "Все категории")
			},
			[postsPerPage, order, orderBy, category] // каждый раз получаем новые посты если изменили postsPerPage
		);
	});

	const categories = useSelect((select) => {
		return select('core').getEntityRecords('taxonomy', 'category', {
			per_page: -1,
		});
	}, []); // зависимости не передает так как они не меняются, мы просто получаем все категории из базы

	// console.log(categories);

	const blockProps = useBlockProps({
		className: 'wp-block-vitos-dynamicblock',
	});

	const onChangeToogleImage = (value) => {
		setAttributes({ showImage: value });
	};

	const onChangePostsPerPage = (value) => {
		setAttributes({ postsPerPage: value });
	};

	const onChangeOrder = (value) => {
		setAttributes({ order: value });
	};
	const onChangeOrderBy = (value) => {
		setAttributes({ orderBy: value });
	};

	const onCategoryChange = (value) => {
		setAttributes({ category: value });
	};

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<ToggleControl
						label="Display Images"
						checked={showImage}
						onChange={onChangeToogleImage}
					/>
					<QueryControls
						numberOfItems={postsPerPage}
						onNumberOfItemsChange={onChangePostsPerPage}
						maxItems={6}
						minItems={1}
						order={order}
						onOrderChange={onChangeOrder}
						orderBy={orderBy}
						onOrderByChange={onChangeOrderBy}
						categoriesList={categories}
						selectedCategoryId={category}
						onCategoryChange={onCategoryChange}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				{posts &&
					posts.map((post) => {
						const featuredImage =
							post._embedded &&
							post._embedded['wp:featuredmedia'] &&
							post._embedded['wp:featuredmedia'].length > 0 &&
							post._embedded['wp:featuredmedia'][0];
						return (
							<div key={post.id}>
								{showImage && featuredImage && (
									<img
										src={
											featuredImage.media_details.sizes
												.full.source_url
										}
										alt={featuredImage.alt_text}
									/>
								)}
								{post.date_gmt && (
									<time dateTime={format('c', post.date_gmt)}>
										{dateI18n(
											getSettings().formats.date, // Это формат даты, заданный в настройках WordPress, например: d.m.Y или F j, Y
											post.date_gmt // сама дата, которую нужно отформатировать
										)}
									</time>
								)}
								<h2>
									<a href={post.link}>
										{post.title.rendered}
									</a>
								</h2>
							</div>
						);
					})}
			</div>
		</>
	);
}

/*
	dateI18n(...)
		Функция из WordPress-пакета @wordpress/date, которая:
		Применяет локализацию (например, русские месяцы).
		Учитывает часовой пояс сайта.
		Применяет формат из getSettings().formats.date.
*/
