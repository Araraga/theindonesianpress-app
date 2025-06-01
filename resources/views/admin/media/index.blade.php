@extends('admin.layout')

@section('title', 'Media Manager')

@section('content')
<div class="space-y-6" x-data="mediaManager()">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Media Manager</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola file media, gambar, dan dokumen</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <button @click="createFolder = true" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Buat Folder
            </button>
            <button @click="uploadModal = true" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                Upload File
            </button>
        </div>
    </div>

    <!-- Breadcrumb & View Toggle -->
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <button @click="currentPath = ''" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Media
                        </button>
                    </li>
                    <template x-for="folder in breadcrumbs" :key="folder">
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <button @click="navigateToFolder(folder)" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2" x-text="folder"></button>
                            </div>
                        </li>
                    </template>
                </ol>
            </nav>

            <!-- View Toggle -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">View:</span>
                <button @click="viewMode = 'grid'" :class="{ 'bg-indigo-100 text-indigo-700': viewMode === 'grid' }" 
                        class="p-2 rounded-md hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </button>
                <button @click="viewMode = 'list'" :class="{ 'bg-indigo-100 text-indigo-700': viewMode === 'list' }" 
                        class="p-2 rounded-md hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 17.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-4">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Files</dt>
                            <dd class="text-lg font-medium text-gray-900">247</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Images</dt>
                            <dd class="text-lg font-medium text-gray-900">186</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Documents</dt>
                            <dd class="text-lg font-medium text-gray-900">45</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Storage Used</dt>
                            <dd class="text-lg font-medium text-gray-900">85.2 MB</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- File Explorer -->
    <div class="bg-white shadow rounded-lg">
        <!-- Grid -->
        <div x-show="viewMode === 'grid'" class="p-6">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                <!-- Folders -->
                <template x-for="folder in sampleFolders" :key="folder.name">
                    <div @dblclick="navigateToFolder(folder.name)" 
                         class="group relative flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-gray-400 cursor-pointer">
                        <svg class="w-12 h-12 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <span class="mt-2 text-sm font-medium text-gray-900 text-center" x-text="folder.name"></span>
                        <span class="text-xs text-gray-500" x-text="folder.count + ' items'"></span>
                    </div>
                </template>

                <!-- Files -->
                <template x-for="file in sampleFiles" :key="file.name">
                    <div @click="selectFile(file)" 
                         :class="{ 'ring-2 ring-indigo-500': selectedFile?.name === file.name }"
                         class="group relative flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-gray-300 cursor-pointer">
                        <!-- Image Preview -->
                        <template x-if="file.type === 'image'">
                            <img :src="file.preview" :alt="file.name" class="w-16 h-16 object-cover rounded-md">
                        </template>
                        
                        <!-- Document Icon -->
                        <template x-if="file.type === 'document'">
                            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </template>

                        <span class="mt-2 text-sm font-medium text-gray-900 text-center truncate w-full" x-text="file.name"></span>
                        <span class="text-xs text-gray-500" x-text="file.size"></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- List View -->
        <div x-show="viewMode === 'list'" class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modified</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Folders -->
                    <template x-for="folder in sampleFolders" :key="folder.name">
                        <tr @dblclick="navigateToFolder(folder.name)" class="hover:bg-gray-50 cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900" x-text="folder.name"></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Folder</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="folder.count + ' items'"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="folder.modified"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-indigo-600 hover:text-indigo-900">Options</button>
                            </td>
                        </tr>
                    </template>

                    <!-- Files -->
                    <template x-for="file in sampleFiles" :key="file.name">
                        <tr @click="selectFile(file)" 
                            :class="{ 'bg-indigo-50': selectedFile?.name === file.name }"
                            class="hover:bg-gray-50 cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <template x-if="file.type === 'image'">
                                        <img :src="file.preview" :alt="file.name" class="w-8 h-8 object-cover rounded mr-3">
                                    </template>
                                    <template x-if="file.type === 'document'">
                                        <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </template>
                                    <span class="text-sm font-medium text-gray-900" x-text="file.name"></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="file.extension.toUpperCase()"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="file.size"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="file.modified"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-indigo-600 hover:text-indigo-900">Options</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Selected File Details -->
    <div x-show="selectedFile" x-transition class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">File Details</h3>
        <template x-if="selectedFile">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <template x-if="selectedFile.type === 'image'">
                        <img :src="selectedFile.preview" :alt="selectedFile.name" class="w-full max-w-md mx-auto rounded-lg shadow">
                    </template>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Name</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="selectedFile.name"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Size</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="selectedFile.size"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Type</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="selectedFile.extension.toUpperCase()"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Modified</label>
                        <p class="mt-1 text-sm text-gray-900" x-text="selectedFile.modified"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">URL</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" :value="selectedFile.url" readonly 
                                   class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <button @click="copyToClipboard(selectedFile.url)"
                                    class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 text-sm hover:bg-gray-100">
                                Copy
                            </button>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Download
                        </button>
                        <button class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Upload Modal -->
    <div x-show="uploadModal" x-transition class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Upload Files</h3>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="mt-4">
                        <label for="file-upload" class="cursor-pointer">
                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                Drop files here or click to browse
                            </span>
                            <input id="file-upload" name="file-upload" type="file" multiple class="sr-only">
                        </label>
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-3 mt-6">
                    <button @click="uploadModal = false" 
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <button class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function mediaManager() {
    return {
        viewMode: 'grid',
        uploadModal: false,
        createFolder: false,
        selectedFile: null,
        currentPath: '',
        breadcrumbs: [],
        
        sampleFolders: [
            { name: 'Articles Images', count: 45, modified: '2 days ago' },
            { name: 'User Avatars', count: 23, modified: '1 week ago' },
            { name: 'Documents', count: 12, modified: '3 days ago' },
            { name: 'Logos', count: 8, modified: '5 days ago' }
        ],
        
        sampleFiles: [
            {
                name: 'featured-image-1.jpg',
                type: 'image',
                extension: 'jpg',
                size: '2.4 MB',
                modified: '2 hours ago',
                preview: 'https://picsum.photos/400/300?random=1',
                url: '/storage/media/featured-image-1.jpg'
            },
            {
                name: 'article-banner.png',
                type: 'image',
                extension: 'png',
                size: '1.8 MB',
                modified: '4 hours ago',
                preview: 'https://picsum.photos/400/300?random=2',
                url: '/storage/media/article-banner.png'
            },
            {
                name: 'press-release.pdf',
                type: 'document',
                extension: 'pdf',
                size: '856 KB',
                modified: '1 day ago',
                preview: null,
                url: '/storage/media/press-release.pdf'
            },
            {
                name: 'news-photo.jpg',
                type: 'image',
                extension: 'jpg',
                size: '3.2 MB',
                modified: '3 hours ago',
                preview: 'https://picsum.photos/400/300?random=3',
                url: '/storage/media/news-photo.jpg'
            },
            {
                name: 'editorial-guide.docx',
                type: 'document',
                extension: 'docx',
                size: '245 KB',
                modified: '2 days ago',
                preview: null,
                url: '/storage/media/editorial-guide.docx'
            }
        ],
        
        selectFile(file) {
            this.selectedFile = file;
        },
        
        navigateToFolder(folderName) {
            this.currentPath = folderName;
            this.breadcrumbs = folderName.split('/').filter(item => item !== '');
        },
        
        copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('URL copied to clipboard!');
            });
        }
    }
}
</script>
@endsection