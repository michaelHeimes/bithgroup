// /assets/js/column-reverse.js
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

console.log("loaded");

// 1. Add attribute
addFilter(
	'blocks.registerBlockType',
	'bith/column-reverse-attribute',
	(settings, name) => {
		if (name !== 'core/columns') return settings;
		return {
			...settings,
			attributes: {
				...settings.attributes,
				reverseMobile: { type: 'boolean', default: false }
			}
		};
	}
);

// 2. Add Toggle to Sidebar
addFilter(
	'editor.BlockEdit',
	'bith/column-reverse-control',
	createHigherOrderComponent((BlockEdit) => {
		return (props) => {
			if (props.name !== 'core/columns') return <BlockEdit {...props} />;
			const { attributes, setAttributes } = props;

			return (
				<Fragment>
					<BlockEdit {...props} />
					<InspectorControls>
						<PanelBody title="Mobile Settings">
							<ToggleControl
								label="Reverse Order on Mobile"
								checked={attributes.reverseMobile}
								onChange={(val) => setAttributes({ reverseMobile: val })}
							/>
						</PanelBody>
					</InspectorControls>
				</Fragment>
			);
		};
	}, 'withInspectorControl')
);

// 3. Save class to database
addFilter(
	'blocks.getSaveContent.extraProps',
	'bith/column-reverse-class',
	(extraProps, blockType, attributes) => {
		if (blockType.name === 'core/columns' && attributes.reverseMobile) {
			extraProps.className = [extraProps.className, 'mobile-row-reverse'].filter(Boolean).join(' ');
		}
		return extraProps;
	}
);
