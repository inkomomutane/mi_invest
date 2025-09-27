
export type FileData = {
    name: string;
    size: string;
    type: string;
    url: string;
};

const createUrl = (file: File) => {
    return URL.createObjectURL(file);
};

const calcFileSize = (size: number) => {
    if (size === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(size) / Math.log(k));
    return parseFloat((size / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const ImageTypes = new Map<string>([
    ['image/jpeg', 'jpg'],
    ['image/png', 'png'],
    ['image/gif', 'gif'],
    ['image/bmp', 'bmp'],
    ['image/webp', 'webp'],
    ['.jpg', 'jpg'],
    ['.png', 'png'],
    ['.gif', 'gif'],
    ['.bmp', 'bmp'],
    ['.webp', 'webp'],
]);

const PdfTypes = new Map<string>([
    ['application/pdf', 'pdf'],
    ['application/x-pdf', 'pdf'],
    ['application/acrobat', 'pdf'],
    ['applications/vnd.pdf', 'pdf'],
    ['.pdf', 'pdf'],
]);

enum FILETYPES {
    IMAGE = 'image',
    PDF = 'pdf',
    FILE = 'file',
}

const fileType = (file: File | FileData) => {
    if (ImageTypes.has(file.type)) {
        return FILETYPES.IMAGE;
    }

    if (PdfTypes.has(file.type)) {
        return FILETYPES.PDF;
    }

    return FILETYPES.FILE;
};

export { calcFileSize, createUrl, fileType, FILETYPES };
