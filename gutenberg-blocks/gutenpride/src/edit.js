import {__} from '@wordpress/i18n';
import {useBlockProps, InspectorControls,} from '@wordpress/block-editor';

import './editor.scss';

const {useSelect} = wp.data;
import {
	PanelBody,
	ToggleControl,
	SelectControl,
	Card,
	CardHeader,
	CardBody,
	CardFooter,
	CardMedia,
	__experimentalText as Text,
	__experimentalHeading as Heading,
	__experimentalItemGroup as ItemGroup,
	__experimentalItem as Item,
} from '@wordpress/components';

export default function Edit({attributes, setAttributes}) {
	//hooks
	const getAllCategory = useSelect((select) => {
		return select('core').getEntityRecords('taxonomy', 'category');
	});

	const getSelectedCatItems = useSelect((select) => {
		return select('core').getEntityRecords('postType', 'post', {
			categories: attributes.selectedCategory || 0, per_page: 5
		})
	})

	//Block Properties
	const blockProps = useBlockProps();
	//Check isResolved
	if (!getAllCategory) {
		return (<p {...blockProps}>Loading..</p>);
	}
	console.log(getSelectedCatItems)
	//Count Total Post
	const countPost = (attributes.showPostCounts) ? 1 : 0;
	//Author display status
	const showAuthorStatus = (attributes.displayAuthor) ? 1 : 0;
	//Featured Image status
	const showFutureImage = (attributes.displayFutureImg) ? 1 : 0;

	//Create category select dropdown options
	const categoryOptions = getAllCategory.map(function (item) {
		return {key: item.id, label: item.name, value: item.id}
	});
	let selectOpt = [{key: 0, label: 'Select Category', value: ''}];
	const selectAllOpt = selectOpt.concat(categoryOptions);
	//Check isResolved
	if (!getSelectedCatItems) {
		return (<p {...blockProps}>Loading items..</p>);
	}

	//Create Post List React function Component
	const PostList = function () {
		return (getSelectedCatItems.length ? <ItemGroup>
			{getSelectedCatItems.map((item) => <Item key={item.id}><Card key={item.id}>
				<CardHeader>
					<Heading size={4}><a href={item.link}>{item.title.raw}</a></Heading>
					{(attributes.displayFutureImg) ? <CardMedia>
						<img src={item.author_info.feature_img[0]} width="20px" height="auto"/>
					</CardMedia> : ''}
				</CardHeader>
				<CardBody>
					{/*<Text dangerouslySetInnerHTML={{__html: item.excerpt.rendered.replace(/(<? *script)/gi, 'illegalscript')}}></Text>*/}
					<Text>{(item.excerpt.raw)}</Text>

				</CardBody>
				<CardFooter>
					<Text>{(attributes.displayAuthor) ? __('Created By: ', 'gutenpride') + item.author_info.display_name : ''}</Text>
					<Text><b>{__('Published: ', 'gutenpride')}</b>{moment(item.date).format("DD/MM/YYYY")}</Text>
				</CardFooter>
			</Card>
			</Item>)}
		</ItemGroup> :
			'Select a category or no items into selected category.');
	}

	//Return whole data for admin view
	return (<div {...blockProps}>
		<InspectorControls>
			<PanelBody title={__('Post Content Settings')}>
				<ToggleControl
					label={__('Show Category Count', 'gutenpride')}
					checked={countPost}
					onChange={(value) => setAttributes({showPostCounts: value})}
				/>

				<ToggleControl
					label={__('Display author name', 'gutenpride')}
					checked={showAuthorStatus}
					onChange={(value) => setAttributes({displayAuthor: value})}
				/>


				<ToggleControl
					label={__('Display Feature Image', 'gutenpride')}
					checked={showFutureImage}
					onChange={(value) => setAttributes({displayFutureImg: value})}
				/>


				<SelectControl
					label={__('Select a Category', 'gutenpride')}
					value={attributes.selectedCategory}
					options={selectAllOpt}
					onChange={(value) => setAttributes({selectedCategory: parseInt(value)})}
				/>
			</PanelBody>
		</InspectorControls>
		<PostList></PostList>
		{countPost ?
			<p><b>{__('Total Posts :', 'gutenpride')} {(countPost) ? getSelectedCatItems.length : ''}</b></p> : ''}
	</div>);
}
