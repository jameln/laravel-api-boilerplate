<?php

return [

	/*
	|--------------------------------------------------------------------------
	| API Docs Profiles
	|--------------------------------------------------------------------------
	|
	| Different possible profiles used for documentation generation based on samples.
	|
	| Each profile is defined with :
	|
	| - defaultRoutePrefix :    Used for routing and added at the end of the computed output base (e.g. public/docs/developer/v1)
	| - outputPathBase :        Base of the directory where to generate the documentation (e.g. public/docs/developer)
	| - actAsUserId :           User ID used to fake Api access with generator
	| - bindings :              Bindings used to generate samples responses in documentation
	| - routes :                Routes used to generate documentation
	|
	| @see SamplesSeeder
	| @see App\Console\Commands\GenerateApiDocs
	|
	*/
	'profiles' => [

		'Developer' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/Developer')),
			'actAsUserId' => '41abdec2-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// John Smith Sample Project 1
				'projectId' => '1bcc7efc-138c-11e7-93ae-92361f002671',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// End-User,
				'userGroupId' => 'End-User',

				// Algolia
				'search_engine_id' => 'ee87e3b2-1388-11e7-93ae-92361f002671',

				// Owner
				'user_role_id' => 'Owner',

				// en
				'i18nLangId' => 'en',

				// Algolia
				'searchEngineId' => 'ee87e3b2-1388-11e7-93ae-92361f002671',

				// First Sync Item of John Smith Sample Project 1
				'syncItemId' => 'a37eda90-1f56-11e7-93ae-92361f002671',

				// John Smith Sample Project 1 Sync Task
				'syncTaskId' => '8dbfd6e6-2055-11e7-93ae-92361f002671',

				// Public Sync Task
				'public' => 1,

				// Main
				'syncTaskTypeId' => 'Main',

				// Planned
				'syncTaskStatusId' => 'Planned',

				// Project Sync Task "root"
				'root' => 1,

				// E-monsite | Blog
				'dataStreamDecoderId' => '53fd5290-5a4c-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream
				'dataStreamId' => '605d712c-1934-11e7-93ae-92361f002671',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'dataStreamFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog
				'dataStreamPresetId' => '737441b0-57ea-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog - "title" field
				'dataStreamPresetFieldId' => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream Use Case
				'searchUseCaseId' => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'searchUseCaseFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// Search Use Case search query string
				'query_string' => 'site internet',

				// Search Use Case search i18n lang id
				'i18n_lang_id' => 'fr',

				// Search Use Case search page
				'page' => 1,

				// Search Use Case search limit
				'limit' => 5,

				// E-monsite | Blog - Summary
				'searchUseCasePresetId' => '516f0252-7767-11e7-b5a5-be2e44b06b34',

				// Mickey Mouse Sample Project Default Search Use Case - E-monsite | Blog - Photo Widget
				'widgetId' => 'b070b438-781d-11e7-b5a5-be2e44b06b34',

				// E-monsite | Blog - Summary widget preset
				'widgetPresetId' => '6be0a102-7769-11e7-b5a5-be2e44b06b34',

			],
			'routes' => [

				'me.index',

				'meProject.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',

				'user.index',
				'user.show',
				'user.store',
				'user.update',
				'user.destroy',

				'userGroup.index',
				'userGroup.show',

				'userGroupUser.index',

				'userUserHasProject.index',
				'projectUserHasProject.index',

				'userProject.index',

				'project.index',
				'project.show',
				'project.store',
				'project.update',
				'project.destroy',

				'syncItem.index',
				'syncItem.show',
				'syncItem.store',
				'syncItem.update',
				'syncItem.destroy',

				'syncTask.index',
				'syncTask.show',
				'syncTask.store',
				'syncTask.update',
				'syncTask.destroy',

				'syncTaskSyncTask.index',

				'syncTaskSyncTaskLog.index',

				'syncTaskType.index',
				'syncTaskType.show',
				'syncTaskType.store',
				'syncTaskType.update',
				'syncTaskType.destroy',

				'syncTaskTypeVersion.index',
				'syncTaskTypeVersion.show',
				'syncTaskTypeVersion.store',
				'syncTaskTypeVersion.update',
				'syncTaskTypeVersion.destroy',

				'syncTaskTypeSyncTaskTypeVersion.index',

				'syncTaskStatus.index',
				'syncTaskStatus.show',
				'syncTaskStatus.store',
				'syncTaskStatus.update',
				'syncTaskStatus.destroy',

				'syncTaskStatusVersion.index',
				'syncTaskStatusVersion.show',
				'syncTaskStatusVersion.store',
				'syncTaskStatusVersion.update',
				'syncTaskStatusVersion.destroy',

				'syncTaskStatusSyncTaskStatusVersion.index',

				'projectSyncItem.index',

				'projectSyncTask.index',

				'dataStreamDecoder.index',
				'dataStreamDecoder.show',
				'dataStreamDecoder.store',
				'dataStreamDecoder.update',
				'dataStreamDecoder.destroy',

				'dataStream.index',
				'dataStream.show',
				'dataStream.store',
				'dataStream.update',
				'dataStream.destroy',

				'dataStreamDataStreamField.index',

				'dataStreamField.index',
				'dataStreamField.show',
				'dataStreamField.store',
				'dataStreamField.update',
				'dataStreamField.destroy',

				'dataStreamPreset.index',
				'dataStreamPreset.show',
				'dataStreamPreset.store',
				'dataStreamPreset.update',
				'dataStreamPreset.destroy',

				'dataStreamPresetDataStreamPresetField.index',

				'dataStreamPresetField.index',
				'dataStreamPresetField.show',
				'dataStreamPresetField.store',
				'dataStreamPresetField.update',
				'dataStreamPresetField.destroy',

				'projectDataStream.show',
				'projectDataStream.store',
				'projectDataStream.update',
				'projectDataStream.destroy',

				'userHasProject.index',
				'userHasProject.show',
				'userHasProject.store',
				'userHasProject.update',
				'userHasProject.destroy',

				'i18nLang.index',
				'i18nLang.show',
				'i18nLang.store',
				'i18nLang.update',
				'i18nLang.destroy',

				'searchEngine.index',
				'searchEngine.show',
				'searchEngine.store',
				'searchEngine.update',
				'searchEngine.destroy',

				'searchEngineProject.index',

				'i18nLangSyncTaskTypeVersion.index',

				'dataStreamHasI18nLang.index',
				'dataStreamHasI18nLang.show',
				'dataStreamHasI18nLang.store',
				'dataStreamHasI18nLang.update',
				'dataStreamHasI18nLang.destroy',

				'dataStreamDataStreamHasI18nLang.index',

				'dataStreamI18nLang.index',

				'i18nLangDataStream.index',

				'projectSearchUseCase.index',

				'searchUseCase.index',
				'searchUseCase.show',
				'searchUseCase.store',
				'searchUseCase.update',
				'searchUseCase.destroy',

				'searchUseCase.search',

				'searchUseCaseField.index',
				'searchUseCaseField.show',
				'searchUseCaseField.store',
				'searchUseCaseField.update',
				'searchUseCaseField.destroy',

				'searchUseCaseSearchUseCaseField.index',

				'searchUseCasePreset.index',
				'searchUseCasePreset.show',
				'searchUseCasePreset.store',
				'searchUseCasePreset.update',
				'searchUseCasePreset.destroy',

				'searchUseCasePresetField.index',
				'searchUseCasePresetField.show',
				'searchUseCasePresetField.store',
				'searchUseCasePresetField.update',
				'searchUseCasePresetField.destroy',

				'searchUseCasePresetSearchUseCasePresetField.index',

				'widget.index',
				'widget.show',
				'widget.store',
				'widget.update',
				'widget.destroy',

				'searchUseCaseWidget.index',

				'widgetPreset.index',
				'widgetPreset.show',
				'widgetPreset.store',
				'widgetPreset.update',
				'widgetPreset.destroy',

				'searchUseCasePresetWidgetPreset.index',

				'dataStreamPresetSearchUseCasePreset.index',

				'dataStreamPresetWidgetPreset.index',

			]

		],

		'Support' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/Support')),
			'actAsUserId' => '41abdec2-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// John Smith Sample Project 1
				'projectId' => '1bcc7efc-138c-11e7-93ae-92361f002671',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// End-User,
				'userGroupId' => 'End-User',

				// Algolia
				'search_engine_id' => 'ee87e3b2-1388-11e7-93ae-92361f002671',

				// Owner
				'user_role_id' => 'Owner',

				// en
				'i18nLangId' => 'en',

				// Algolia
				'searchEngineId' => 'ee87e3b2-1388-11e7-93ae-92361f002671',

				// First Sync Item of John Smith Sample Project 1
				'syncItemId' => 'a37eda90-1f56-11e7-93ae-92361f002671',

				// John Smith Sample Project 1 Sync Task
				'syncTaskId' => '8dbfd6e6-2055-11e7-93ae-92361f002671',

				// Public Sync Task
				'public' => 1,

				// Main
				'syncTaskTypeId' => 'Main',

				// Planned
				'syncTaskStatusId' => 'Planned',

				// Project Sync Task "root"
				'root' => 1,

				// E-monsite | Blog
				'dataStreamDecoderId' => '53fd5290-5a4c-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream
				'dataStreamId' => '605d712c-1934-11e7-93ae-92361f002671',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'dataStreamFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog
				'dataStreamPresetId' => '737441b0-57ea-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog - "title" field
				'dataStreamPresetFieldId' => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream Use Case
				'searchUseCaseId' => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'searchUseCaseFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// Search Use Case search query string
				'query_string' => 'site',

				// Search Use Case search i18n lang id
				'i18n_lang_id' => 'fr',

				// Search Use Case search page
				'page' => 1,

				// Search Use Case search limit
				'limit' => 5,

				// E-monsite | Blog - Summary
				'searchUseCasePresetId' => '516f0252-7767-11e7-b5a5-be2e44b06b34',

				// Mickey Mouse Sample Project Default Search Use Case - E-monsite | Blog - Photo Widget
				'widgetId' => 'b070b438-781d-11e7-b5a5-be2e44b06b34',

				// E-monsite | Blog - Summary widget preset
				'widgetPresetId' => '6be0a102-7769-11e7-b5a5-be2e44b06b34',
			],
			'routes' => [

				'me.index',

				'meProject.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',

				'user.index',
				'user.show',
				'user.store',
				'user.update',
				'user.destroy',

				'userGroup.index',
				'userGroup.show',

				'userGroupUser.index',

				'userUserHasProject.index',
				'projectUserHasProject.index',

				'userProject.index',

				'project.index',
				'project.show',
				'project.store',
				'project.update',
				'project.destroy',

				'syncItem.index',
				'syncItem.show',

				'syncTask.index',
				'syncTask.show',

				'syncTaskSyncTask.index',

				'syncTaskSyncTaskLog.index',

				'syncTaskType.index',
				'syncTaskType.show',

				'syncTaskTypeVersion.index',
				'syncTaskTypeVersion.show',
				'syncTaskTypeVersion.store',
				'syncTaskTypeVersion.update',

				'syncTaskTypeSyncTaskTypeVersion.index',

				'syncTaskStatus.index',
				'syncTaskStatus.show',

				'syncTaskStatusVersion.index',
				'syncTaskStatusVersion.show',
				'syncTaskStatusVersion.store',
				'syncTaskStatusVersion.update',

				'syncTaskStatusSyncTaskStatusVersion.index',

				'projectSyncItem.index',

				'projectSyncTask.index',

				'dataStreamDecoder.index',
				'dataStreamDecoder.show',
				'dataStreamDecoder.store',
				'dataStreamDecoder.update',
				'dataStreamDecoder.destroy',

				'dataStream.index',
				'dataStream.show',
				'dataStream.store',
				'dataStream.update',
				'dataStream.destroy',

				'dataStreamDataStreamField.index',

				'dataStreamField.index',
				'dataStreamField.show',
				'dataStreamField.store',
				'dataStreamField.update',
				'dataStreamField.destroy',

				'dataStreamPreset.index',
				'dataStreamPreset.show',
				'dataStreamPreset.store',
				'dataStreamPreset.update',
				'dataStreamPreset.destroy',

				'dataStreamPresetDataStreamPresetField.index',

				'dataStreamPresetField.index',
				'dataStreamPresetField.show',
				'dataStreamPresetField.store',
				'dataStreamPresetField.update',
				'dataStreamPresetField.destroy',

				'userHasProject.index',
				'userHasProject.show',
				'userHasProject.store',
				'userHasProject.update',
				'userHasProject.destroy',

				'i18nLang.index',
				'i18nLang.show',

				'searchEngine.index',
				'searchEngine.show',

				'searchEngineProject.index',

				'i18nLangSyncTaskTypeVersion.index',

				'dataStreamHasI18nLang.index',
				'dataStreamHasI18nLang.show',
				'dataStreamHasI18nLang.store',
				'dataStreamHasI18nLang.update',
				'dataStreamHasI18nLang.destroy',

				'dataStreamDataStreamHasI18nLang.index',

				'dataStreamI18nLang.index',

				'i18nLangDataStream.index',

				'projectSearchUseCase.index',

				'searchUseCase.index',
				'searchUseCase.show',
				'searchUseCase.store',
				'searchUseCase.update',
				'searchUseCase.destroy',

				'searchUseCase.search',

				'searchUseCaseField.index',
				'searchUseCaseField.show',
				'searchUseCaseField.store',
				'searchUseCaseField.update',
				'searchUseCaseField.destroy',

				'searchUseCaseSearchUseCaseField.index',

				'searchUseCasePreset.index',
				'searchUseCasePreset.show',
				'searchUseCasePreset.store',
				'searchUseCasePreset.update',
				'searchUseCasePreset.destroy',

				'searchUseCasePresetField.index',
				'searchUseCasePresetField.show',
				'searchUseCasePresetField.store',
				'searchUseCasePresetField.update',
				'searchUseCasePresetField.destroy',

				'searchUseCasePresetSearchUseCasePresetField.index',

				'widget.index',
				'widget.show',
				'widget.store',
				'widget.update',
				'widget.destroy',

				'searchUseCaseWidget.index',

				'widgetPreset.index',
				'widgetPreset.show',
				'widgetPreset.store',
				'widgetPreset.update',
				'widgetPreset.destroy',

				'searchUseCasePresetWidgetPreset.index',

				'dataStreamPresetSearchUseCasePreset.index',

				'dataStreamPresetWidgetPreset.index',

			]

		],

		'End-User' => [

			'defaultRoutePrefix' => 'v1',
			'outputPathBase' => realpath(base_path('public/docs/End-User')),
			'actAsUserId' => '605c7610-1389-11e7-93ae-92361f002671',
			'bindings' => [

				// Notification filter
				'read_status' => 'unread',

				// Notification
				'notificationId' => '5b0decfd-6f95-4e76-be12-8cc7fef976b0',

				// John Smith Sample Project 1
				'projectId' => '1bcc7efc-138c-11e7-93ae-92361f002671',

				// John Smith
				'userId' => '605c7610-1389-11e7-93ae-92361f002671',

				// Algolia
				'search_engine_id' => 'ee87e3b2-1388-11e7-93ae-92361f002671',

				// Owner
				'user_role_id' => 'Owner',

				// en
				'i18nLangId' => 'en',

				// First Sync Item of John Smith Sample Project 1
				'syncItemId' => 'a37eda90-1f56-11e7-93ae-92361f002671',

				// John Smith Sample Project 1 Sync Task
				'syncTaskId' => '8dbfd6e6-2055-11e7-93ae-92361f002671',

				// Public Sync Task
				'public' => false,

				// Main
				'syncTaskTypeId' => 'Main',

				// Planned
				'syncTaskStatusId' => 'Planned',

				// E-monsite | Blog
				'dataStreamDecoderId' => '53fd5290-5a4c-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream
				'dataStreamId' => '605d712c-1934-11e7-93ae-92361f002671',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'dataStreamFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog
				'dataStreamPresetId' => '737441b0-57ea-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog - "title" field
				'dataStreamPresetFieldId' => 'eb9cb642-5bf3-11e7-907b-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream Use Case
				'searchUseCaseId' => 'dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0',

				// Mickey Mouse Sample Project Data Stream - "title" field
				'searchUseCaseFieldId' => '36116fa6-5c0d-11e7-907b-a6006ad3dba0',

				// E-monsite | Blog - Summary
				'searchUseCasePresetId' => '516f0252-7767-11e7-b5a5-be2e44b06b34',

				// Search Use Case search query string
				'query_string' => 'site internet',

				// Search Use Case search i18n lang id
				'i18n_lang_id' => 'fr',

				// Search Use Case search page
				'page' => 1,

				// Search Use Case search limit
				'limit' => 5,

				// Mickey Mouse Sample Project Default Search Use Case - E-monsite | Blog - Photo Widget
				'widgetId' => 'b070b438-781d-11e7-b5a5-be2e44b06b34',

				// E-monsite | Blog - Summary widget preset
				'widgetPresetId' => '6be0a102-7769-11e7-b5a5-be2e44b06b34',

			],
			'routes' => [

				'me.index',

				'meProject.index',

				'meNotification.index',
				'meNotification.updateRead',
				'meNotification.updateUnread',

				'project.show',
				'project.store',
				'project.update',
				'project.destroy',

				'syncTaskSyncTaskLog.index',

				'syncTaskType.index',
				'syncTaskType.show',

				'syncTaskTypeVersion.index',
				'syncTaskTypeVersion.show',

				'syncTaskTypeSyncTaskTypeVersion.index',

				'syncTaskStatus.index',
				'syncTaskStatus.show',

				'syncTaskStatusVersion.index',
				'syncTaskStatusVersion.show',

				'syncTaskStatusSyncTaskStatusVersion.index',

				'projectSyncItem.index',

				'projectSyncTask.index',

				'dataStreamDecoder.index',
				'dataStreamDecoder.show',
				
				'projectDataStream.show',
				'projectDataStream.store',
				'projectDataStream.update',
				'projectDataStream.destroy',

				'dataStream.show',

				'i18nLang.index',
				'i18nLang.show',

				'i18nLangSyncTaskTypeVersion.index',

				'projectSearchUseCase.index',

				'searchUseCase.show',
				'searchUseCase.store',
				'searchUseCase.update',
				'searchUseCase.destroy',

				'searchUseCase.search',

				'searchUseCaseField.show',
				'searchUseCaseField.store',
				'searchUseCaseField.update',
				'searchUseCaseField.destroy',

				'searchUseCaseSearchUseCaseField.index',

				'searchUseCasePreset.index',
				'searchUseCasePreset.show',

				'searchUseCasePresetField.index',
				'searchUseCasePresetField.show',

				'searchUseCasePresetSearchUseCasePresetField.index',

				'widget.show',
				'widget.store',
				'widget.update',
				'widget.destroy',

				'searchUseCaseWidget.index',

				'widgetPreset.index',
				'widgetPreset.show',

				'searchUseCasePresetWidgetPreset.index',

				'dataStreamPresetSearchUseCasePreset.index',

				'dataStreamPresetWidgetPreset.index',

			]

		],

	]

];
